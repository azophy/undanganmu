<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function display_site($url_name)
    {
        $site = Site::where('url_name',$url_name)->first();
        if ($site)
            return view($site->template->path, [
                'site' => $site,
                'info' => json_decode($site->option),
            ]);
        else
            abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function display_site_lokasi($url_name)
    {
        $site = Site::where('url_name',$url_name)->first();
        $info = json_decode($site->option);
        if ($site)
            return redirect("https://www.google.com/maps/search/?api=1&query=".$info->event_loc_1_lat.", ".$info->event_loc_1_long);
        else
            abort(404);
    }
}
