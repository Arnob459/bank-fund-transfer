<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;





class CheckUsernameController extends Controller
{
    //
    public function Checkusername(Request $request){
        // return response()->json(['status' => 'done']);

            $query = $request->get('query');

            // return $query;
                $data = User::where('username', $query)->where('status',1)
                    ->first();
                    // return $data;

            if($data)
            {
                return response()->json($data);

            }
            else{
                return response()->json(['status' => 'Invalid username ']);


            }



    }
    public function checkemail(Request $request){
        // return response()->json(['status' => 'done']);

            $query = $request->get('query');

            // return $query;
                $data = User::where('email', $query)
                    ->first();
                    // return $data;

            if($data)
            {
                return response()->json(['status' => true]);


            }
            else{
                return response()->json(['status' => false]);

            }



    }
    public function checkphone(Request $request){

            $query = $request->get('query');

                $data = User::where('phone', $query)
                    ->first();

            if($data)
            {
                return response()->json(['status' => true]);

            }
            else{
                return response()->json(['status' => false]);

            }



    }

    // public function pass(){
    //       $pass = Admin::where('username', 'admin')->first();
    //       $pass->password = Hash::make('admin');
    //       $pass->save();



    //       }




}
