@extends('layouts.app')

@section('title', 'Create Item')

@section('content')
<div class="container">
    <h1>Create Item</h1>
    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" required>
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Select a Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" class="form-control" id="total" name="total" value="{{ $item->total }}" required>
        </div>
        <div class="form-group">
            <label for="broke_count">Broke Item currently: {{ $item->broke_count }}</label>
            @error('broke_count')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <input type="number" class="form-control" id="broke_count" name="broke_count" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>
@endsection
