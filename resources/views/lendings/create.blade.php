@extends('layouts.app')

@section('title', 'Create Lending')

@section('content')
<div class="container">
    <h1>Create Lending</h1>
    <form action="{{ route('lendings.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="item_id">Item</label>
            @error('invalid_amount')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <select class="form-control" id="item_id" name="item_id" required>
                <option value="">Select an Item</option>
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description">
        </div>
        <div class="form-group">
            <label for="amount_borrowed">Amount Borrowed</label>
            <input type="number" class="form-control" id="amount_borrowed" name="amount_borrowed" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>
@endsection
