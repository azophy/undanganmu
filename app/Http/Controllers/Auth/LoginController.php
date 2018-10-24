<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function username()
    {
        return 'username';
    }

    public function getSocialRedirect( $provider )
    {
        $providerKey = Config::get('services.' . $provider);

        if (empty($providerKey)) {
            return redirect()->to('/login')
                ->with('status', 'danger')
                ->with('message', 'Error : No such provider');
        }

        return Socialite::driver( $provider )->redirect();
    }

    public function getSocialHandle( $provider )
    {
        if (Input::get('denied') != '') {
            return redirect()->to('/login')
                ->with('status', 'danger')
                ->with('message', 'You did not share your profile data with our social app.');
        }

        $user = Socialite::driver( $provider )->user();

        session(['user_info' => $user]);

        return redirect('/');
    }


}
