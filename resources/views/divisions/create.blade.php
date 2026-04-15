@extends('layouts.app')

@section('title', 'Create Division')

@section('content')
<div class="container">
    <h1>Create Division</h1>
    <form action="{{ route('divisions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>
@endsection
