<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;

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
        $input['password'] = Hash::make($input['password']);

        if ($model = User::create($input)) {
            return redirect()->route('admin.user.index')->with('status', 'Creating user "'.$model->url_name.'" succeed');
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
        $input = User::validate($request);
        if (!empty($input['password']))
            $input['password'] = Hash::make($input['password']);

        if ($user->update($input)) {
            return redirect()->route('admin.user.index')->with('status', 'Updating user "'.$user->url_name.'" succeed');
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
        $url_name = $user->url_name;
        if ($user->delete())
            return redirect()->route('admin.user.index')->with('status', 'Deleting user "'.$url_name.'" succeed');
        else
            return redirect()->route('admin.user.index')->with('status', 'Deleting user "'.$url_name.'" failed');
    }
}
