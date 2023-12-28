<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;
use App\Models\CardType;


class CardController extends Controller
{

    public function cardTypes()
    {
        $page_title = 'All Card Types';
        $card_types = CardType::latest()->paginate(config('constants.table.default'));
        return view('admin.card.card_types', compact('page_title', 'card_types'));
    }

    public function cardTypeCreate(){
        $data['page_title'] = ' Card Type Create';
        return view('admin.card.card_types_create',$data);
    }

    public function cardTypeStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            try {
                $path = config('constants.card.path');
                $size = config('constants.card.size');
                $filename = upload_image($request->image, $path, $size);
            } catch (\Exception $exp) {

                return back()->with('error','Image could not be uploaded');
            }
        }
        $CardType = new CardType();
        $CardType->name = $request->name;
        $CardType->image =  $filename;
        $CardType->status = 1;
        $CardType->save();
        return back()->with('success',' Card Type Created Successfully');

    }

    public function cardTypeActivate(Request $request)
    {
        $request->validate(['id' => 'required|integer']);

        $CardType = CardType::where('id', $request->id)->first();

        $CardType->update(['status' => 1]);

        return back()->with('success', ' Card Type has been activated.');
    }

    public function cardTypeDectivate(Request $request)
    {
        $request->validate(['id' => 'required|integer']);

        $CardType = CardType::where('id', $request->id)->first();

        $CardType->update(['status' => 2]);

        return back()->with('success', 'Card Type has been deactivated.');
    }

    public function cards()
    {
        $page_title = 'All cards';
        $cards = Card::with(['user','cardType'])->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No cards is created';
        return view('admin.card.cards', compact('page_title', 'cards', 'empty_message'));
    }

    public function cardActivate(Request $request)
    {
        $request->validate(['id' => 'required|integer']);

        $card = Card::where('id', $request->id)->first();
        $card->update(['status' => 1]);

        return back()->with('success', ' Card has been activated.');
    }

    public function cardDectivate(Request $request)
    {
        $request->validate(['id' => 'required|integer']);

        $card = Card::where('id', $request->id)->first();

        $card->update(['status' => 2]);

        return back()->with('success', 'Card Request has been Rejected.');
    }



}
