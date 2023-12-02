<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Title;

use App\Models\Faq;

class FaqController extends Controller
{
    //Faq
       public function Faq()
       {
           $data['page_title'] = 'FAQ';
           $data['faq'] = Title::where('key_value', 'faq')->first();
           $data['faqs'] = Faq::all();
           return view('admin.pages.faq.index',$data);
       }

       public function faqSectionUpdate(Request $request)
       {
           $this->validate($request, [
               'faq_title' => 'required|string|max:255',
               'faq_subtitle' => 'required|string|max:255',
           ]);

           $data = Title::where('key_value', 'faq')->first();
           $data->title = $request->faq_title;
           $data->sub_title = $request->faq_subtitle;
           $data->save();
           return back()->with('success','Updated Successfully');
       }

       public function faqCreate(){
           $data['page_title'] = ' FAQ Create';
           return view('admin.pages.faq.create',$data);
       }

       public function faqStore(Request $request){

           $this->validate($request, [
             'qus' => 'required|string|max:255',
             'ans' => 'required|string',
           ]);


           $faq = new Faq();
           $faq->question =  $request->qus;
           $faq->answer =  $request->ans;
           $faq->save();
           return redirect()->route('admin.faq')->with('success','FAQ Create Successfully');

       }

       public function faqEdit($id) {
           $data['page_title'] = 'FAQ Edit';
           $data['faq'] = Faq::findOrfail($id);
           return view('admin.pages.faq.edit',$data);
       }
       public function faqUpdate(Request $request, $id){
        $this->validate($request, [
            'qus' => 'required|string|max:255',
            'ans' => 'required|string',
          ]);
           $faq = Faq::find($id);
           $faq->question =  $request->qus;
           $faq->answer =  $request->ans;
           $faq->save();
           return back()->with('success','Updated Successfully');
       }


        public function destroy($id)
        {
            $data = Faq::find($id);
            if (!$data) {
                return redirect()->back()->with('success', ' Deleted successfully');
            }
            $data->delete();
            return redirect()->back()->with('success', ' Deleted successfully');
        }

}
