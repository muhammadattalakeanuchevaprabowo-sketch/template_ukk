@extends('layouts.app')

@section('title', 'Division')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('divisions.create') }}" class="btn btn-primary">
        + Tambah Division
    </a>
</div>

<table id="divisionTable">
    <thead>
        <tr>
            <th>no</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($divisions as $division)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $division->name }}</td>
                <td>
                    <a href="{{ route('divisions.edit', $division->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('divisions.destroy', $division->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
$(document).ready(function () {
    $('#divisionTable').DataTable();
});
</script>
@endsection
