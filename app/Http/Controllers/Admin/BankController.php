<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use App\Http\Controllers\Controller;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $page_title = 'Banks';
        $empty_message = 'No Bank available.';
        $banks = Bank::latest()->paginate(config('constants.table.default'));
        return view('admin.bank.list', compact('page_title', 'empty_message', 'banks'));
    }

    public function create()
    {
        $page_title = 'Create New Bank';
        return view('admin.bank.create', compact('page_title'));
    }

    public function edit($id)
    {
        $page_title = 'Edit Bank';
        $bank = Bank::findOrfail($id);
        return view('admin.bank.edit', compact('page_title', 'bank'));
    }

    public function store(Request $request)
    {

        $validation_rule = [
            'name'           => 'required|max: 60',
            'image'          => 'required|image|mimes:jpeg,jpg,png',
            'routing_number' => 'required',
            'processing_time'=> 'required',
            'minimum_limit'      => 'required|numeric|gte:0',
            'maximum_limit'   => 'required|numeric|gt:0',
            'percent_charge' => 'required|between:0,100',
            'fixed_charge' => 'required|numeric|gte:0',
            'ud.*'           => 'required',
        ];

        $request->validate($validation_rule, [], ['ud.*' => 'All user data']);

        if ($request->hasFile('image')) {
            try {
                $filename = upload_image($request->image, config('constants.bank.path'), config('constants.bank.size'));
            } catch (\Exception $exp) {
                return back()->withErrors('Image could not be uploaded.');
            }
        }

        $bank = Bank::create([
            'name' => $request->name,
            'routing_number' => $request->routing_number,
            'processing_time' => $request->processing_time,
            'minimum_limit' => $request->minimum_limit,
            'maximum_limit' => $request->maximum_limit,
            'percent_charge' => $request->percent_charge,
            'fixed_charge' => $request->fixed_charge,
            'image' => $filename,
            'status' => 0,
            'user_data' => $request->ud ? json_encode($request->ud) : json_encode([]),
        ]);

        return back()->withSuccess($bank->name . ' has been added.');
    }

    public function update(Request $request, $id)
    {
        $validation_rule = [
            'name'           => 'required|max: 60',
            'image'          => 'image|mimes:jpeg,jpg,png',
            'routing_number' => 'required',
            'processing_time'=> 'required',
            'minimum_limit'      => 'required|numeric|gte:0',
            'maximum_limit'   => 'required|numeric|gt:0',
            'percent_charge' => 'required|between:0,100',
            'fixed_charge' => 'required|numeric|gte:0',
            'ud.*'           => 'required',
        ];

        $request->validate($validation_rule, [], ['ud.*' => 'All user data']);
        $bank = Bank::findOrfail($id);

        $filename = $bank->image;
        if ($request->hasFile('image')) {
            try {
                $filename = upload_image($request->image, config('constants.bank.path'), config('constants.bank.size'));
            } catch (\Exception $exp) {
                $notify[] = [];
                return back()->withError('Image could not be uploaded.');
            }
        }

        $bank->update([
            'name' => $request->name,
            'routing_number' => $request->routing_number,
            'processing_time' => $request->processing_time,
            'minimum_limit' => $request->minimum_limit,
            'maximum_limit' => $request->maximum_limit,
            'percent_charge' => $request->percent_charge,
            'fixed_charge' => $request->fixed_charge,
            'image' => $filename,
            'status' => 0,
            'user_data' => $request->ud ? json_encode($request->ud) : json_encode([]),
        ]);

        return back()->withSuccess($bank->name . ' has been updated.');
    }

    public function activate(Request $request)
    {
        $request->validate(['id' => 'required|integer']);

        $bank = Bank::where('id', $request->id)->first();

        $bank->update(['status' => 1]);

        return back()->with('success', $bank->name . ' has been activated.');
    }

    public function deactivate(Request $request)
    {
        $request->validate(['id' => 'required|integer']);

        $bank = Bank::where('id', $request->id)->first();

        $bank->update(['status' => 0]);

        return back()->with('success', $bank->name . ' has been deactivated.');
    }
}
