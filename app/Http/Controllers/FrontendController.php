<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Choose;
use App\Models\Title;
use App\Models\Counter;
use App\Models\Work;
use App\Models\Blog;
use App\Models\Faq;


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

    public function aboutus()
    {

        $data['page_title'] = "About Us";
        $data['testimonials'] = Testimonial::all();

        $data['testimonial_title'] = Title::where('key_value','testimonial')->first();

        return view('frontend.about', $data);

    }

    public function blog()
    {

        $data['page_title'] = "blog";
        $data['blogs'] = Blog::all();

        $data['blog_title'] = Title::where('key_value','blog')->first();

        return view('frontend.blog', $data);

    }

    public function help()
    {

        $data['page_title'] = "Help";
        $data['faqs'] = Faq::all();

        $data['faq_title'] = Title::where('key_value','faq')->first();

        return view('frontend.help', $data);

    }

    public function contact()
    {

        $data['page_title'] = "Contact us";

        return view('frontend.contact', $data);

    }

    public function terms()
    {

        $data['page_title'] = "Terms";
        $data['terms'] = Title::where('key_value','terms')->first();

        return view('frontend.terms', $data);

    }

    public function privacy()
    {

        $data['page_title'] = "Privacy";
        $data['privacy'] = Title::where('key_value','privacy')->first();

        return view('frontend.privacy', $data);

    }

}
