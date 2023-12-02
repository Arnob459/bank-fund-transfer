<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use App\Models\TicketComment;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller {

    public function indexSupport() {
        $page_title = "Support Ticket";
        $all_ticket = SupportTicket::orderBy('id', 'desc')->paginate(15);

        return view('admin.support.support', compact('all_ticket', 'page_title'));
    }

    public function adminSupport($ticket) {
        $ticket_object = SupportTicket::where('ticket', $ticket)->first();
        $ticket_data = TicketComment::where('ticket_id', $ticket)->get();
        $username = User::find($ticket_object->user_id);
        $page_title = "Support Ticket Reply";
        return view('admin.support.view_reply', compact('ticket_object', 'ticket_data', 'username', 'page_title'));
    }

    public function adminReply(Request $request, $ticket) {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        TicketComment::create([
            'ticket_id' => $ticket,
            'type' => 0,
            'comment' => $request->comment,
        ]);

        SupportTicket::where('ticket', $ticket)
            ->update([
                'status' => 2
            ]);

        return redirect()->back()->withSuccess('Message Send Successful');
    }

    //for user
    public function ticketIndex() {
        $all_ticket = SupportTicket::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')->paginate(15);
        $page_title = "Support Tickets";
        return view('users.support.support', compact('all_ticket', 'page_title'));
    }

    public function ticketCreate() {
        $pt = "Create New Ticket";
        return view('users.support.add_ticket', compact('pt'));
    }

    public function ticketStore(Request $request) {
        $this->validate($request, [
            'subject' => 'required|string|max:191',
            'message' => 'required|string',
        ]);

        $ticket = SupportTicket::create([
            'subject' => $request->subject,
            'ticket' => getTrx(),
            'user_id' => auth()->id(),
            'status' => 1,
        ]);

        TicketComment::create([
            'ticket_id' => $ticket->ticket,
            'type' => 1,
            'comment' => $request->message,
        ]);
        return redirect()->route('user.ticket.customer.reply', $ticket->ticket)->withSuccess("Successfully Created Ticket");
    }

    public function ticketReply($ticket) {
        $ticket_object = SupportTicket::where('user_id', auth()->id())
            ->where('ticket', $ticket)->first();
        $ticket_data = TicketComment::where('ticket_id', $ticket)->latest()->get();
        $page_title = "Reply Ticket";

        if ($ticket_object == '') {
            return redirect('/');
        } else {
            return view('users.support.view_reply', compact('ticket_data', 'ticket_object', 'page_title'));
        }
    }

    public function ticketReplyStore(Request $request, $ticket) {
        $this->validate($request, [
            'message' => 'required|string'
        ]);

        TicketComment::create([
            'ticket_id' => $ticket,
            'type' => 1,
            'comment' => $request->message,
        ]);

        SupportTicket::where('ticket', $ticket)
            ->update([
                'status' => 3
            ]);

        return redirect()->back()->withSuccess('Message Send Successful');
    }

    public function ticketClose($ticket) {
        SupportTicket::where('ticket', $ticket)
            ->update([
                'status' => 9
            ]);
        return redirect()->back()->withSuccess('Conversation closed');
    }

}
