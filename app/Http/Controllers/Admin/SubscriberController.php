<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
   public function index()
   {
       $data['page_title'] = "Subscribers";
       $data['subscribers'] = Subscriber::orderBy('id', 'desc')->paginate(15);
       return view('admin.subscriber.index', $data);
   }

   public function mail()
   {
       $data['page_title'] = "Subscribers";
       $data['subscribers'] = Subscriber::orderBy('id', 'desc')->paginate(15);
       return view('admin.subscriber.mail', $data);
   }
    public function sendMail(Request $request)
    {
        $request->validate([
        'subject' => 'required|string|max:191',
        'message' => 'required|string',
        ]);


        if (!Subscriber::first()) return back()->withErrors(['No subscribers to send email.']);
        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber) {
            $receiver_name = explode('@', $subscriber->email)[0];
            send_general_email($subscriber->email, $request->subject, $request->message, $receiver_name);
        }

        return back()->with('success','Email will be sent to all subscribers.');

    }


   public function show ()
   {
       $data['page_title'] = "Subscribers";
       $data['subscribers'] = Subscriber::latest()->paginate(15);
       return view('admin.subscriber.mail', $data);
   }


}
