<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Site;

class MainController extends Controller
{
    public function index() {
        return view('member.index');
    }

    public function edit_site() {
        return view('member.edit_site', [
            'model' => Auth::user()->sites()->first(),
        ]);
    }

    public function update_site(Request $request)
    {
        $input = Site::validate($request,[
            'id_user'       => '',
            'url_name'      => '',
        ]);
        $input['option'] = json_encode($request->input('option_data'));

        $site = Auth::user()->sites()->first();

        if ($site->update($input)) {
            return redirect()->route('member.edit_site')->with('status', 'Updating site "'.$site->url_name.'" succeed');
        } else
            return redirect()->route('member.edit_site')->with('status', 'Error');
    }
}
