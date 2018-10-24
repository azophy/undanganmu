<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Site;
use App\Template;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $input = User::validate($request,[
            'url_name' => 'string|required|unique:site,url_name',
        ]);
        $input['password'] = Hash::make($input['password']);

        if ($model = User::create($input)) {
            if ($site = Site::create([
                'id_user'     => $model->id,
                'id_template' => env('DEFAULT_TEMPLATE_ID'),
                'url_name'    => $input['url_name'],
                'option'      => json_encode(Site::$option_default),
            ]))
                return redirect()->route('member.site')->with('status', 'Welcome "'.$model->url_name.'"! Now lets prepare your site. Fill the form below');
        }
        return redirect()->route('register')->with('status', 'Error');

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $user_info = session('user_info',null);

        if ($user_info != null && $user_info->email) { 
            $params['has_socmed_login'] = true;
            $params['socmed_login_name'] = ($user_info->name) ?: '';
            $params['socmed_login_email'] = $user_info->email;
        } else {
            $params['has_socmed_login'] = false;
        }

        return view('auth.register', $params);
    }
}
