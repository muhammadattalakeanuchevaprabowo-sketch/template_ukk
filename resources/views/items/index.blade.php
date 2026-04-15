@extends('layouts.app')

@section('title', 'Item')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

@if (auth()->user()->role == 'admin')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('items.create') }}" class="btn btn-primary">
        + Tambah Item
    </a>

    <a href="{{ route('items.export') }}" class="btn btn-success ms-2">
    Export Excel
    </a>
</div>
@endif

<table id="itemTable">
    <thead>
        <tr>
            <th>no</th>
            <th>Name</th>
            <th>Category</th>
            <th>Total</th>
            <th>Available</th>
            <th>Broke Item</th>
            <th>Amount Borrowed</th>
            {{-- <th>Actions</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category->name }}</td>
                <td>{{ $item->total }}</td>
                <td>{{ $item->getAvailableAttribute() }}</td>
                <td>{{ $item->broke_count }}</td>
                <td>{{ $item->lendings->sum('amount_borrowed') }}</td>
                {{-- <td>
                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td> --}}
            </tr>
        @endforeach
    </tbody>
</table>

<script>
$(document).ready(function () {
    $('#itemTable').DataTable();
});
</script>
@endsection
