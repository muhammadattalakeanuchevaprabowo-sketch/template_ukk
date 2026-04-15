@extends('layouts.app')

@section('title', 'Create User')

@section('content')
<div class="container">
    <h1>Create User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="">Select Role</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="staff" {{ $user->role === 'staff' ? 'selected' : '' }}>Staff</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan jika ingin mengubah kata sandi">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>
@endsection
