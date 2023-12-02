<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SettingExtra;
use App\Models\Slider;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    //
        //Banner
        public function Banner()
        {
            $data['page_title'] = 'Banner Update';
            $data['banner'] = SettingExtra::first();
            return view('admin.pages.banner',$data);
        }

        public function bannerUpdate(Request $request)
        {
            $this->validate($request, [
                'banner_title' => 'required|string|max:255',
                'banner_subtitle' => 'required|string|max:255',
                'banner_bg_img' => 'image|mimes:jpeg,png,jpg|max:2048',
                'banner_img' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $data = SettingExtra::first();

            if ($request->hasFile('banner_bg_img')) {
                $filename = $data->bg_image;
                try {
                    $path = config('constants.banner.path');
                    $size = config('constants.banner.size');
                    remove_file(config('constants.banner.path') . '/' .$data->bg_image);
                    $filename = upload_image($request->banner_bg_img, $path, $size, $filename);
                } catch (\Exception $exp) {

                    return back()->with('error','Image could not be uploaded');
                }
                $data->bg_image = $filename;
            }
            if ($request->hasFile('banner_img')) {
                $filename = $data->image;
                try {
                    $path = config('constants.banner_image.path');
                    $size = config('constants.banner_image.size');
                    remove_file(config('constants.banner_image.path') . '/' .$data->image);
                    $filename = upload_image($request->banner_img, $path, $size, $filename);
                } catch (\Exception $exp) {

                    return back()->withWarning('Image could not be uploaded');
                }
                $data->image = $filename;
            }

            $data->banner_title = $request->banner_title;
            $data->banner_sub_title = $request->banner_subtitle;
            $data->save();
            return back()->with('success','Updated Successfully');
        }

}
