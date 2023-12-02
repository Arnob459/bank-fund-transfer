<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Title;
use App\Models\Service;


class ServiceController extends Controller
{

    //Services
      public function Service()
      {
          $data['page_title'] = 'Services';
          $data['service'] = Title::where('key_value', 'service')->first();
          $data['services_list'] = Service::all();
          return view('admin.pages.service.index',$data);
      }

      public function serviceSectionUpdate(Request $request)
      {
          $this->validate($request, [
              'service_title' => 'required|string|max:255',
              'service_subtitle' => 'required|string|max:255',
          ]);

          $data = Title::where('key_value', 'service')->first();
          $data->title = $request->service_title;
          $data->sub_title = $request->service_subtitle;
          $data->save();
          return back()->with('success','Updated Successfully');
      }

      public function servicesCreate(){
          $data['page_title'] = ' Service Create';
          return view('admin.pages.service.create',$data);
      }

      public function servicesStore(Request $request){

          $this->validate($request, [
              'title' => 'required|string|max:255',
              'subtitle' => 'required|string|max:255',
              'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
          ]);

          if ($request->hasFile('image')) {
            try {
                $path = config('constants.service.path');
                $size = config('constants.service.size');
                $filename = upload_image($request->image, $path, $size);
            } catch (\Exception $exp) {

                return back()->with('error','Image could not be uploaded');
            }
        }

          $service = new Service();
          $service->title =  $request->title;
          $service->short_text =  $request->subtitle;
          $service->icon =  $filename;
          $service->status = 1;
          $service->save();
          return back()->with('success','Service Create Successfully');

      }

      public function servicesEdit($id) {
          $data['page_title'] = 'Service Edit';

          $data['service'] = Service::findOrfail($id);
          return view('admin.pages.service.edit',$data);
      }
      public function servicesUpdate(Request $request, $id){
          $this->validate($request, [
              'title' => 'required|string|max:255',
              'subtitle' => 'required|string|max:255',
              'image' => 'image|mimes:jpeg,png,jpg|max:2048',
          ]);

          $data = Service::findOrfail($id);

          if ($request->hasFile('image')) {
              $filename = $data->icon;
              try {
                  $path = config('constants.service.path');
                  $size = config('constants.service.size');
                  remove_file(config('constants.service.path') . '/' .$data->icon);
                  $filename = upload_image($request->image, $path, $size, $filename);
              } catch (\Exception $exp) {

                  return back()->withWarning('Image could not be uploaded');
              }
              $data->icon = $filename;
          }

          $data->title = $request->title;
          $data->short_text = $request->subtitle;
          $data->status = 1;
          $data->save();
          return back()->with('success','service Updated Successfully');
      }
      public function destroy($id)
      {
          $data = Service::find($id);
          if (!$data) {
              return redirect()->back()->with('success', ' Deleted successfully');
          }
          $data->delete();
          return redirect()->back()->with('success', ' Deleted successfully');
      }
}
