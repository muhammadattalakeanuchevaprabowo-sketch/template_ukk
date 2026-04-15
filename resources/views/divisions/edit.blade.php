@extends('layouts.app')

@section('title', 'Edit Division')

@section('content')
<div class="container">
    <h1>Edit Division</h1>
    <form action="{{ route('divisions.update', $division->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $division->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
