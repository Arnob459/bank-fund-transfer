<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SettingExtra;
use App\Models\Slider;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Intervention\Image\Facades\Image;


class SliderController extends Controller
{
    //Slider
        public function Slider()
        {
            $data['page_title'] = 'Sliders';
            $data['sliders'] = Slider::all();
            return view('admin.pages.slider.index',$data);
        }

        public function sliderCreate(){
            $data['page_title'] = 'Add New Slider';
            return view('admin.pages.slider.create',$data);
        }

        public function sliderStore(Request $request){

            $this->validate($request, [
                'title' => 'required|string|max:255',
                'subtitle' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($request->hasFile('image')) {
                try {
                    $path = config('constants.slider.path');
                    $size = config('constants.slider.size');
                    $filename = upload_image($request->image, $path, $size);
                } catch (\Exception $exp) {

                    return back()->withWarning('Image could not be uploaded');
                }
            }

            $slider = new Slider();
            $slider->title =  $request->title;
            $slider->sub_title =  $request->subtitle;
            $slider->image =  $filename;
            $slider->save();
            return back()->with('success','slider Create Successfully');

        }

        public function sliderEdit($id) {
            $data['page_title'] = 'Slider Edit';

            $data['slider'] = Slider::findOrFail($id);
            return view('admin.pages.slider.edit',$data);
        }
        public function sliderUpdate(Request $request, $id){
            $this->validate($request, [
                'title' => 'required|string|max:255',
                'subtitle' => 'required|string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $slider = Slider::findOrfail($id);

            if ($request->hasFile('image')) {
                $filename = $slider->image;
                try {
                    $path = config('constants.slider.path');
                    $size = config('constants.slider.size');
                    remove_file(config('constants.slider.path') . '/' .$slider->image);
                    $filename = upload_image($request->image, $path, $size, $filename);
                } catch (\Exception $exp) {

                    return back()->withWarning('Image could not be uploaded');
                }
                $slider->image = $filename;
            }

            $slider->title =  $request->title;
            $slider->sub_title =  $request->subtitle;
            $slider->save();
            return back()->with('success','slider Updated Successfully');
        }
        public function destroy($id)
        {
            $data = Slider::find($id);
            if (!$data) {
                return redirect()->back()->with('success', ' Deleted successfully');
            }
            remove_file(config('constants.slider.path') . '/' . $data->image);
            $data->delete();
            return redirect()->back()->with('success', ' Deleted successfully');
        }

}
