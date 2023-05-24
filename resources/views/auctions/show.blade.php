@extends('layouts.app')

@section('content')
    <div>
        <h1>{{ $auction->title }}</h1>
        <!-- Display auction details -->

        <h2>Current Highest Bid: {{ $auction->current_bid }}</h2>

        <!-- Bid submission form -->
        <form action="{{ route('auctions.bids.store', $auction) }}" method="POST">
            @csrf
            <input type="number" name="amount" min="{{ $auction->current_bid + $auction->bid_increment }}" required>
            <button type="submit">Place Bid</button>
        </form>
    </div>
@endsection
