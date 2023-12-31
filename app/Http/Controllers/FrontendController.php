<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Choose;
use App\Models\Title;
use App\Models\Counter;
use App\Models\Work;
use App\Models\Testimonial;







class FrontendController extends Controller
{
    //
    public function index(Request $request)
    {


        $data['page_title'] = "Home";
        $data['sliders'] = Slider::all();
        $data['chooses'] = Choose::all();
        $data['counters'] = Counter::all();
        $data['works'] = Work::all();
        $data['testimonials'] = Testimonial::all();



        $data['choose_title'] = Title::where('key_value','choose')->first();
        $data['counter_title'] = Title::where('key_value','counter')->first();
        $data['work_title'] = Title::where('key_value','work')->first();
        $data['testimonial_title'] = Title::where('key_value','testimonial')->first();







        return view('frontend.index', $data);

    }

}
