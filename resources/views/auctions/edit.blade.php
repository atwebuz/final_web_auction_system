@extends('layouts.app')
@section('content')


<h1>Edit Auction</h1>

@if($errors->any())
   <div class="alert alert-danger">
       <ul>
           @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
           @endforeach
       </ul>
   </div>
@endif

<form action="{{ route('auctions.update', $auction) }}" method="POST">
   @csrf
   @method('PUT')
   <div class="form-group">
       <label for="title">Title</label>
       <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $auction->title) }}" required>
   </div>
   <div class="form-group">
       <label for="description">Description</label>
       <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $auction->description) }}</textarea>
   </div>
   <div class="form-group">
       <label for="start_time">Start Time</label>
       <input type="datetime-local" name="start_time" id="start_time" class="form-control" value="{{ old('start_time', $auction->start_time ? $auction->start_time : null) }}">
   </div>
   <div class="form-group">
       <label for="end_time">End Time</label>
       <input type="datetime-local" name="end_time" id="end_time" class="form-control" value="{{ old('end_time', $auction->end_time ? $auction->end_time : null) }}">
   </div>
   <div class="form-group">
       <label for="current_price">Current Price</label>
       <input type="number" name="current_price" id="current_price" class="form-control" value="{{ old('current_price', $auction->current_price) }}" min="0" required>
   </div>
   <button type="submit" class="btn btn-primary">Update</button>
   <a href="{{ route('auctions.index') }}" class="btn btn-secondary">Cancel</a>
</form>


@endsection