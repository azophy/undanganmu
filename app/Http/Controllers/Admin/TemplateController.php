<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Template;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.template.index', [
            'templates' => Template::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.template.create',[
            'model' => new Template(),
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
        $input = Template::validate($request);

        if ($model = Template::create($input)) {
            return redirect()->route('admin.template.index')->with('status', 'Creating template "'.$model->name.'" succeed');
        } else
            return redirect()->route('admin.template.create')->with('status', 'Error');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        return view('admin.template.edit',[
            'model' => $template,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Template $template)
    {
        $input = Template::validate($request);

        if ($template->update($input)) {
            return redirect()->route('admin.template.index')->with('status', 'Updating template "'.$template->name.'" succeed');
        } else
            return redirect()->route('admin.template.edit', ['id' => $template->id])->with('status', 'Error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        $name = $template->name;
        if ($template->delete())
            return redirect()->route('admin.template.index')->with('status', 'Deleting template "'.$name.'" succeed');
        else
            return redirect()->route('admin.template.index')->with('status', 'Deleting template "'.$name.'" failed');
    }

}
