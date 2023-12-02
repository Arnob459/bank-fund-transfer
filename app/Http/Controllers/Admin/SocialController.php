<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{

    public function index()
    {
        $data['page_title'] = 'Social';
        $data['icons'] = Social::all();
        return view('admin.basic.social.index', $data);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|string|max:190',
            'url' => 'required|string|max:190',
        ]);

        $social = new Social;
        $social->icon = $request->icon;
        $social->url = $request->url;
        $social->save();

        return back()-> with('success', 'Social  created successfully');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data['page_title'] = 'Social Edit';
        $data['icon'] = Social::findOrFail($id);
        return view('admin.basic.social.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'icon' => 'required|string|max:190',
            'url' => 'required|string|max:190',
        ]);

        $social =  Social::findorfail($id);
        $social->icon = $request->icon;
        $social->url = $request->url;
        $social->save();

        return back()-> with('success', 'Social updated successfully');
    }


    public function destroy($id)
    {
        $social =  Social::findorfail($id);
        $social->delete();
        return back()-> withSuccess('Social Deleted Successfully');
    }
}
