<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.index', [
            'sites' => Site::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('site.create',[
            'model' => new Site(),
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
        $input = Site::validate($request);

        if ($model = Site::create($input)) {
            return redirect()->route('site.index')->with('status', 'Creating site "'.$model->url_name.'" succeed');
        } else
            return redirect()->route('site.create')->with('status', 'Error');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site)
    {
        return view('site.edit',[
            'model' => $site,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Site $site)
    {
        $input = Site::validate($request);
        $input['option'] = json_encode($request->input('option_data'));

        if ($site->update($input)) {
            return redirect()->route('site.index')->with('status', 'Updating site "'.$site->url_name.'" succeed');
        } else
            return redirect()->route('site.edit', ['id' => $site->id])->with('status', 'Error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        $url_name = $site->url_name;
        if ($site->delete())
            return redirect()->route('site.index')->with('status', 'Deleting site "'.$url_name.'" succeed');
        else
            return redirect()->route('site.index')->with('status', 'Deleting site "'.$url_name.'" failed');
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
}
