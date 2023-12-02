<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SettingExtra;
use App\Models\Title;
use Illuminate\Http\Request;

class SettingExtraController extends Controller
{
    public function about()
    {
        $data['page_title'] = 'About US';
        $data['about'] = SettingExtra::first();
        return  view('admin.pages.about', $data);
    }
    public function aboutUpdate (Request $request)
    {
        $request->validate([
            'about_title' => 'required|string|max:191',
            'about_description' => 'required|string',
            'about_image' => 'image|mimes:jpg,jpeg,png|max:2024',

        ]);
        $data = SettingExtra::first();


        if ($request->hasFile('about_image')) {
            $filename = $data->about_image;
            try {
                $path = config('constants.about.path');
                $size = config('constants.about.size');
                remove_file(config('constants.about.path') . '/' .$data->about_image);
                $filename = upload_image($request->about_image, $path, $size, $filename);
            } catch (\Exception $exp) {

                return back()->withWarning('Image could not be uploaded');
            }
            $data->about_image = $filename;
        }
        $data->about_title = $request->about_title;
        $data->about_des = $request->about_description;
        $data->save();
        return back()->with('success', 'Banner Update successfully');

    }


    //Terms
    public function Terms()
    {
        $data['page_title'] = 'Terms & Conditions';
        $data['terms'] = Title::where('key_value', 'terms')->first();
        return view('admin.pages.terms',$data);
    }

    public function termsUpdate(Request $request)
    {
        $this->validate($request, [
            'terms_title' => 'required|string|max:255',
            'terms_description' => 'required|string',
        ]);

        $data = Title::where('key_value', 'terms')->first();
        $data->title = $request->terms_title;
        $data->sub_title = $request->terms_description;
        $data->save();
        return back()->with('success','Updated Successfully');
    }

            //Privacy
        public function Privacy()
        {
            $data['page_title'] = 'privacy & policy';
            $data['privacy'] = Title::where('key_value', 'privacy')->first();
            return view('admin.pages.privacy',$data);
        }

        public function privacyUpdate(Request $request)
        {
            $this->validate($request, [
                'privacy_title' => 'required|string|max:255',
                'privacy_description' => 'required|string',
            ]);

            $data = Title::where('key_value', 'privacy')->first();
            $data->title = $request->privacy_title;
            $data->sub_title = $request->privacy_description;
            $data->save();
            return back()->with('success','Updated Successfully');
        }


}
