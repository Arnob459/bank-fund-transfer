<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Title;
use App\Models\Counter;

class CounterController extends Controller
{
                //Counter
                public function Counter()
                {
                    $data['page_title'] = 'Counter';
                    $data['counter'] = Title::where('key_value', 'counter')->first();
                    $data['counters'] = Counter::all();
                    return view('admin.pages.counter.index',$data);
                }

                public function counterSectionUpdate(Request $request)
                {
                    $this->validate($request, [
                        'counter_title' => 'required|string|max:255',
                        'counter_subtitle' => 'required|string|max:255',
                    ]);

                    $data = Title::where('key_value', 'counter')->first();
                    $data->title = $request->counter_title;
                    $data->sub_title = $request->counter_subtitle;
                    $data->save();
                    return back()->with('success','Updated Successfully');
                }

                public function counterCreate(){
                    $data['page_title'] = ' Counter Create';
                    return view('admin.pages.counter.create',$data);
                }

                public function counterStore(Request $request){

                    $this->validate($request, [
                      'icon' => 'required|string|max:255',
                      'title' => 'required|string|max:255',
                      'number' => 'required|string|max:255',
                    ]);


                    $counter = new Counter();
                    $counter->icon =  $request->icon;
                    $counter->title =  $request->title;
                    $counter->number =  $request->number;
                    $counter->save();
                    return redirect()->route('admin.counter')->with('success','Counter Create Successfully');

                }

                public function counterEdit($id) {
                    $data['page_title'] = 'Counter Edit';
                    $data['counter'] = Counter::find($id);
                    return view('admin.pages.counter.edit',$data);
                }
                public function counterUpdate(Request $request, $id){
                    $this->validate($request, [
                      'icon' => 'required|string|max:255',
                      'title' => 'required|string|max:255',
                      'number' => 'required|string|max:255',
                    ]);

                    $counter = Counter::find($id);
                    $counter->icon =  $request->icon;
                    $counter->title =  $request->title;
                    $counter->number =  $request->number;
                    $counter->save();
                    return back()->with('success','Updated Successfully');
                }
                public function destroy($id)
                {
                    $data = Counter::find($id);
                    if (!$data) {
                        return redirect()->back()->with('success', ' Deleted successfully');
                    }
                    $data->delete();
                    return redirect()->back()->with('success', ' Deleted successfully');
                }
}
