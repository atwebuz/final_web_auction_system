@extends('layouts.app')
@section('content')

<h1>Auctions</h1>

@if(session('success'))
   <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('auctions.create') }}" class="btn btn-primary mb-3">Create Auction</a>

<table class="table">
   <thead>
       <tr>
           <th>Title</th>
           <th>Description</th>
           <th>Start Time</th>
           <th>End Time</th>
           <th>Current Price</th>
           <th>Action</th>
       </tr>
   </thead>
   <tbody>
       @forelse($auctions as $auction)
           <tr>
               <td>{{ $auction->title }}</td>
               <td>{{ $auction->description }}</td>
               <td>{{ $auction->start_time }}</td>
               <td>{{ $auction->end_time }}</td>
               <td>{{ $auction->current_price }}</td>
               <td>
                   <a href="{{ route('auctions.show', $auction->id) }}">View Auction</a>
                   <a href="{{ route('auctions.edit', $auction) }}" class="btn btn-sm btn-primary">Edit</a>
                   <form action="{{ route('auctions.destroy', $auction) }}" method="POST" class="d-inline">
                       @csrf
                       @method('DELETE')
                       <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this auction?')">Delete</button>
                   </form>
               </td>
           </tr>
       @empty
           <tr>
               <td colspan="6">No auctions found.</td>
           </tr>
       @endforelse
   </tbody>
</table>


@endsection