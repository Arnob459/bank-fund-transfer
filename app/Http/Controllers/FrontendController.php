<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function index(Request $request)
    {


        $data['page_title'] = "Home";

        return view('frontend.index', $data);

    }

}
