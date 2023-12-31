<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Setting;
use App\Models\Trx;
use App\Models\User;
use App\Models\Transfer;
use App\Models\Bank;
use App\Models\Account;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['page_title'] = 'Money Transfer' ;
        $data['user'] = Auth::user();
        $data['account'] = Account::where('user_id', Auth::id())->where('status', 1)->count();
        $data['card'] = Account::where('user_id', Auth::id())->where('status', 1)->count();
        $data['logs'] = Transfer::where('user_id', Auth::id())->with(['receiver','bank'])->orderBy('id', 'desc')->paginate(config('constants.table.default'));
        return view('user.home',$data);
    }
}
