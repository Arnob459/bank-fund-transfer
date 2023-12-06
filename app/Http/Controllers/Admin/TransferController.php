<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Models\Trx;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transfer;

class TransferController extends Controller
{
    public function ownbankPending()
    {
        $page_title = 'Pending Transfers';
        $transfers = Transfer::where('status', 2)->where('type', 1)->where('bank_type', 2)->with(['user','receiver'])->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No transfer is pending';
        return view('admin.transfer.ownbank_transfers', compact('page_title', 'transfers', 'empty_message'));
    }

    public function ownbankApproved()
    {
        $page_title = 'Approved Transfers';
        $transfers = Transfer::where('status', 1)->where('type', 1)->where('bank_type', 2)->with(['user','receiver'])->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No transfer is approved';
        return view('admin.transfer.ownbank_transfers', compact('page_title', 'transfers', 'empty_message'));
    }

    public function ownbankRejected()
    {
        $page_title = 'Rejected transfers';
        $transfers = Transfer::where('status', 3)->where('type', 1)->where('bank_type', 2)->with(['user','receiver'])->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No transfer is rejected';
        return view('admin.transfer.ownbank_transfers', compact('page_title', 'transfers', 'empty_message'));
    }

    public function ownbankLog(Request $request)
    {
        if ($request->user){
            $user = User::findOrFail($request->user);
            $page_title = 'Transfer History | ' .$user->username;
            $transfers = Transfer::where('user_id', $user->id)->where('status', '!=', 0)->where('type', 1)->where('bank_type', 2)->with(['user','receiver'])->latest()->paginate(config('constants.table.default'));
            $empty_message = 'No transfer history';
            return view('admin.transfer.ownbank_transfers', compact('page_title', 'transfers', 'empty_message'));
        }
        $page_title = 'Transfer History';
        $transfers = Transfer::where('status', '!=', 0)->where('type', 1)->where('bank_type', 2)->with(['user','receiver'])->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No transfer history';
        return view('admin.transfer.ownbank_transfers', compact('page_title', 'transfers', 'empty_message'));
    }

    public function ownbankApprove(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $transfer = Transfer::where('id',$request->id)->where('status',2)->firstOrFail();
        $transfer->status = 1;
        $transfer->admin_feedback = $request->details;
        $transfer->save();
        $user = User::find($transfer->receiver_id);
        $user->balance += formatter_money($transfer->final_amount);
        $user->save();

        return redirect()->route('admin.ownbank.transfer.pending')->with('success', 'transfer Marked  as Approved.');
    }

    public function ownbankReject(Request $request)
    {
        $general = Setting::first();
        $request->validate(['id' => 'required|integer']);
        $transfer = Transfer::where('id',$request->id)->where('status',2)->firstOrFail();
        $transfer->status = 3;
        $transfer->admin_feedback = $request->details;
        $transfer->save();
        $user = User::find($transfer->user_id);
        $user->balance += formatter_money($transfer->amount);
        $user->save();

        Trx::create([
            'user_id' => $transfer->user_id,
            'amount' => $transfer->amount,
            'post_balance' => $user->balance,
            'charge' => 0,
            'trx_type' => '+',
            'remark' => 'transfer_refund',
            'details' => formatter_money($transfer->amount) . ' ' . $general->cur . ' Refunded from transfer Rejection',
            'trx' => getTrx(),
            'type' => 1,
        ]);

        return redirect()->route('admin.ownbank.transfer.pending')->with('success', 'transfer has been rejected.');
    }
    public function pending()
    {
        $page_title = 'Pending Transfers';
        $transfers = Transfer::where('status', 2)->where('type', 1)->where('bank_type', 1)->with(['user','bank'])->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No transfer is pending';
        return view('admin.transfer.transfers', compact('page_title', 'transfers', 'empty_message'));
    }

    public function approved()
    {
        $page_title = 'Approved Transfers';
        $transfers = Transfer::where('status', 1)->with(['user','bank'])->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No transfer is approved';
        return view('admin.transfer.transfers', compact('page_title', 'transfers', 'empty_message'));
    }

    public function rejected()
    {
        $page_title = 'Rejected transfers';
        $transfers = Transfer::where('status', 3)->with(['user','bank'])->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No transfer is rejected';
        return view('admin.transfer.transfers', compact('page_title', 'transfers', 'empty_message'));
    }

    public function log(Request $request)
    {
        if ($request->user){
            $user = User::findOrFail($request->user);
            $page_title = 'Transfer History | ' .$user->username;
            $transfers = Transfer::where('user_id', $user->id)->where('status', '!=', 0)->where('type', 1)->where('bank_type', 1)->with(['user','bank'])->latest()->paginate(config('constants.table.default'));
            $empty_message = 'No transfer history';
            return view('admin.transfer.transfers', compact('page_title', 'transfers', 'empty_message'));
        }
        $page_title = 'Transfer History';
        $transfers = Transfer::where('status', '!=', 0)->where('type', 1)->where('bank_type', 1)->with(['user','bank'])->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No transfer history';
        return view('admin.transfer.transfers', compact('page_title', 'transfers', 'empty_message'));
    }

    public function approve(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $transfer = Transfer::where('id',$request->id)->where('status',2)->firstOrFail();
        $transfer->status = 1;
        $transfer->admin_feedback = $request->details;
        $transfer->save();


        $general = Setting::first();

        return redirect()->route('admin.transfer.pending')->with('success', 'transfer Marked  as Approved.');
    }

    public function reject(Request $request)
    {
        $general = Setting::first();
        $request->validate(['id' => 'required|integer']);
        $transfer = Transfer::where('id',$request->id)->where('status',2)->firstOrFail();
        $transfer->status = 3;
        $transfer->admin_feedback = $request->details;
        $transfer->save();
        $user = User::find($transfer->user_id);
        $user->balance += formatter_money($transfer->amount);
        $user->save();

        Trx::create([
            'user_id' => $transfer->user_id,
            'amount' => $transfer->amount,
            'post_balance' => $user->balance,
            'charge' => 0,
            'trx_type' => '+',
            'remark' => 'transfer_refund',
            'details' => formatter_money($transfer->amount) . ' ' . $general->cur . ' Refunded from transfer Rejection',
            'trx' => getTrx(),
            'type' => 2,
        ]);

        return redirect()->route('admin.transfer.pending')->with('success', 'transfer has been rejected.');
    }

}
