<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Title;
use App\Models\Work;


class WorkController extends Controller
{

    //Work
      public function Work()
      {
          $data['page_title'] = 'How its Work';
          $data['work'] = Title::where('key_value', 'work')->first();
          $data['works'] = Work::all();
          return view('admin.pages.work.index',$data);
      }

      public function workSectionUpdate(Request $request)
      {
          $this->validate($request, [
              'work_title' => 'required|string|max:255',
              'work_subtitle' => 'required|string|max:255',
          ]);

          $data = Title::where('key_value', 'work')->first();
          $data->title = $request->work_title;
          $data->sub_title = $request->work_subtitle;
          $data->save();
          return back()->with('success','Updated Successfully');
      }

      public function workCreate(){
          $data['page_title'] = ' How its Work Create';
          return view('admin.pages.work.create',$data);
      }

      public function workStore(Request $request){

          $this->validate($request, [
            'icon' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
          ]);


          $work = new Work();
          $work->icon =  $request->icon;
          $work->title =  $request->title;
          $work->short_text =  $request->subtitle;
          $work->save();
          return redirect()->route('admin.work')->with('success','Work Create Successfully');

      }

      public function workEdit($id) {
          $data['page_title'] = 'How its Work Edit';
          $data['work'] = Work::find($id);
          return view('admin.pages.work.edit',$data);
      }
      public function workUpdate(Request $request, $id){
            $this->validate($request, [
                'icon' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'subtitle' => 'required|string|max:255',
            ]);
          $work = Work::find($id);
          $work->icon =  $request->icon;
          $work->title =  $request->title;
          $work->short_text =  $request->subtitle;
          $work->save();
          return back()->with('success','Updated Successfully');
      }
      public function destroy($id)
      {
          $data = Work::find($id);
          if (!$data) {
              return redirect()->back()->with('success', ' Deleted successfully');
          }
          $data->delete();
          return redirect()->back()->with('success', ' Deleted successfully');
      }

}
