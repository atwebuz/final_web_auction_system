<?php 
namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use Auth;
use Illuminate\Http\Request;
use Redirect;

class BidController extends Controller
{
    
public function store(Request $request, Auction $auction)
{
    $validatedData = $request->validate([
        'amount' => 'required|numeric|min:' . ($auction->current_bid + $auction->bid_increment),
    ]);

    // Save the bid
    $bid = new Bid();
    $bid->auction_id = $auction->id;
    $bid->user_id = auth()->user()->id;
    $bid->amount = $validatedData['amount'];
    $bid->save();

    // Update the current bid of the auction
    $auction->current_bid = $bid->amount;
    $auction->save();

    return Redirect::route('auctions.show', $auction->id)->with('success', 'Bid placed successfully.');
}
    

}
