<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;

class BranchController extends Controller
{

    public function branches()
    {
        $page_title = 'All Branches';
        $branches = Branch::latest()->paginate(config('constants.table.default'));
        $empty_message = 'No branch added';
        return view('admin.branch.branches', compact('page_title', 'branches', 'empty_message'));
    }

    public function branchStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'routing_number' => 'required|string|max:255',
        ]);
        $branch = new Branch();
        $branch->name = $request->name;
        $branch->routing_number = $request->routing_number;
        $branch->status = 1;
        $branch->save();
        return back()->with('success',' Branch Created Successfully');

    }

    public function branchActivate(Request $request)
    {
        $request->validate(['id' => 'required|integer']);

        $bank = Branch::where('id', $request->id)->first();

        $bank->update(['status' => 1]);

        return back()->with('success', ' Branch has been activated.');
    }

    public function branchDectivate(Request $request)
    {
        $request->validate(['id' => 'required|integer']);

        $bank = Branch::where('id', $request->id)->first();

        $bank->update(['status' => 2]);

        return back()->with('success', 'Branch has been deactivated.');
    }



}
