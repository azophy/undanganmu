<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return view('admin.site.index', [
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
        return view('admin.site.create',[
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
        $input['option'] = json_encode($request->input('option_data'));

        if ($model = Site::create($input)) {
            return redirect()->route('admin.site.index')->with('status', 'Creating site "'.$model->url_name.'" succeed');
        } else
            return redirect()->route('admin.site.create')->with('status', 'Error');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site)
    {
        return view('admin.site.edit',[
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
        $input = Site::validate($request, [], $site);
        $input['option'] = json_encode($request->input('option_data'));

        if ($site->update($input)) {
            return redirect()->route('admin.site.index')->with('status', 'Updating site "'.$site->url_name.'" succeed');
        } else
            return redirect()->route('admin.site.edit', ['id' => $site->id])->with('status', 'Error');
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
            return redirect()->route('admin.site.index')->with('status', 'Deleting site "'.$url_name.'" succeed');
        else
            return redirect()->route('admin.site.index')->with('status', 'Deleting site "'.$url_name.'" failed');
    }
}
