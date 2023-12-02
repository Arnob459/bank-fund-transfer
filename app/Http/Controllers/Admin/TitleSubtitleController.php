<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Title;

class TitleSubtitleController extends Controller
{
        //titleSubtitle
        public function titleSubtitle()
        {
            $data['page_title'] = 'Title Subtitle';
            $data['plan_title'] = Title::where('key_value', 'plan')->first();
            $data['latest_depo_title'] = Title::where('key_value', 'latest_depo')->first();
            $data['gateway_title'] = Title::where('key_value', 'gateway')->first();
            return view('admin.pages.title_subtitle',$data);
        }

        public function titleSubtitleUpdate(Request $request)
        {
            $this->validate($request, [
                'plan_title' => 'required|string|max:255',
                'plan_subtitle' => 'required|string|max:255',
                'deposit_title' => 'required|string|max:255',
                'deposit_subtitle' => 'required|string|max:255',
                'method_title' => 'required|string|max:255',
                'method_subtitle' => 'required|string|max:255',
            ]);

            $plan_title = Title::where('key_value', 'plan')->firstOrFail();
            $plan_title->title = $request->plan_title;
            $plan_title->sub_title = $request->plan_subtitle;
            $plan_title->save();

            $latest_depo_title = Title::where('key_value', 'latest_depo')->firstOrFail();
            $latest_depo_title->title = $request->deposit_title;
            $latest_depo_title->sub_title = $request->deposit_subtitle;
            $latest_depo_title->save();

            $gateway_title = Title::where('key_value', 'gateway')->firstOrFail();
            $gateway_title->title = $request->method_title;
            $gateway_title->sub_title = $request->method_subtitle;
            $gateway_title->save();
            return back()->with('success','Updated Successfully');
        }

}
