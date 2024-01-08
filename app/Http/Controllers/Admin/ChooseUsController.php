<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Title;
use App\Models\Choose;

class ChooseUsController extends Controller
{

     //Why Choose Us
     public function Choose()
     {
         $data['page_title'] = 'Why Choose Us';
         $data['choose'] = Title::where('key_value', 'choose')->first();
         $data['chooses'] = Choose::all();
         return view('admin.pages.choose.index',$data);
     }

     public function chooseSectionUpdate(Request $request)
     {
         $this->validate($request, [
             'choose_title' => 'required|string|max:255',
             'choose_subtitle' => 'required|string|max:255',

         ]);

         $data = Title::where('key_value', 'choose')->first();
         $data->title = $request->choose_title;
         $data->sub_title = $request->choose_subtitle;
         $data->save();
         return back()->with('success','Updated Successfully');
     }

     public function chooseCreate(){
         $data['page_title'] = ' Why Choose Us Create';
         return view('admin.pages.choose.create',$data);
     }

     public function chooseStore(Request $request){

         $this->validate($request, [
           'icon' => 'required|string|max:255',
           'title' => 'required|string|max:255',
           'subtitle' => 'required|string|max:255',
         ]);


         $choose = new Choose();
         $choose->icon =  $request->icon;
         $choose->title =  $request->title;
         $choose->short_text =  $request->subtitle;
         $choose->save();
         return redirect()->route('admin.choose')->with('success',' Create Successfully');

     }

     public function chooseEdit($id) {
         $data['page_title'] = 'Why Choose Us Edit';
         $data['choose'] = Choose::findOrfail($id);
         return view('admin.pages.choose.edit',$data);
     }
     public function chooseUpdate(Request $request, $id){
           $this->validate($request, [
               'icon' => 'required|string|max:255',
               'title' => 'required|string|max:255',
               'subtitle' => 'required|string|max:255',
           ]);
         $choose = Choose::find($id);
         $choose->icon =  $request->icon;
         $choose->title =  $request->title;
         $choose->short_text =  $request->subtitle;
         $choose->save();
         return back()->with('success','Updated Successfully');
     }
     public function destroy($id)
     {
         $data = Choose::find($id);
         if (!$data) {
             return redirect()->back()->with('success', ' Deleted successfully');
         }
         $data->delete();
         return redirect()->back()->with('success', ' Deleted successfully');
     }
}
