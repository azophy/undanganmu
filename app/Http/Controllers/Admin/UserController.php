<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Template;
require_once(base_path('app/Helpers.php'));

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index', [
            'users' => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create',[
            'model' => new User(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = User::validate($request);
        $input['password'] = Hash::make($input['new_password']);
        $input['info'] = json_encode($request->input('info_data'));

        if ($model = User::create($input)) {
            return redirect()->route('admin.user.index')->with('status', 'Creating user "'.$model->username.'" succeed');
        } else
            return redirect()->route('admin.user.create')->with('status', 'Error');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit',[
            'model' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $input = User::validate($request, [], $user);
        $input['info'] = json_encode($request->input('info_data'));
        if (!empty($input['new_password']))
            $input['password'] = Hash::make($input['new_password']);

        if ($user->update($input)) {
            return redirect()->route('admin.user.index')->with('status', 'Updating user "'.$user->username.'" succeed');
        } else
            return redirect()->route('admin.user.edit', ['id' => $user->id])->with('status', 'Error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $username = $user->username;
        if ($user->delete())
            return redirect()->route('admin.user.index')->with('status', 'Deleting user "'.$username.'" succeed');
        else
            return redirect()->route('admin.user.index')->with('status', 'Deleting user "'.$username.'" failed');
    }

    /**
     * Display custom template creation form
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create_custom_template(User $user)
    {
        return view('admin.user.create_custom_template',[
            'user' => $user,
        ]);
    }

    /**
     * Actual custom template creation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store_custom_template(Request $request, User $user)
    {
        $input = Template::validate($request, [
            'base_template_id' => 'integer|required',
        ]);
        $input['id_user'] = $user->id;

        // copy the template folder
        $old_path = explode('.', Template::find($input['base_template_id'])->path)[0];
        $new_path = explode('.', $input['path'])[0];

        $template_path = 'storage/app/templates/';
        //error_log('old_path '. base_path($template_path . $old_path));
        //error_log('new_path '. base_path($template_path . $new_path));
        //exit();
        //xcopy(base_path($template_path . $old_path) , base_path($template_path . $new_path), 775);
        $clone_command = "git clone ". base_path($template_path . $old_path) . ' ' . base_path($template_path . $new_path);
        shell_exec($clone_command);

        if ($model = Template::create($input)) {
            return redirect()->route('admin.user.edit', ['id' => $user->id])->with('status', 'Creating template "'.$model->name.'" succeed');
        } else
            return redirect()->route('admin.user.edit', ['id' => $user->id])->with('status', 'Error');
    }
}
