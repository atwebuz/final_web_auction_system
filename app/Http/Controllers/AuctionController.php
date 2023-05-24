<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function index()
    {
        $auctions = Auction::all();
        return view('auctions.index', compact('auctions'));
    }

    public function create()
    {
        return view('auctions.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after:start_time',
            'current_price' => 'required|numeric|min:0',
        ]);

        Auction::create($validatedData);

        return redirect()->route('auctions.index')->with('success', 'Auction created successfully!');
    }

    public function show($id)
    {
        $auction = Auction::findOrFail($id);
        $bids = Bid::where('auction_id', $auction->id)->orderBy('created_at', 'desc')->get();
    
        return view('auctions.show', compact('auction', 'bids'));
    }

    public function edit(Auction $auction)
    {
        return view('auctions.edit', compact('auction'));
    }

    public function update(Request $request, Auction $auction)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after:start_time',
            'current_price' => 'required|numeric|min:0',
        ]);

        $auction->update($validatedData);

        return redirect()->route('auctions.index')->with('success', 'Auction updated successfully!');
    }

    public function destroy(Auction $auction)
    {
        $auction->delete();

        return redirect()->route('auctions.index')->with('success', 'Auction deleted successfully!');
    }
}
