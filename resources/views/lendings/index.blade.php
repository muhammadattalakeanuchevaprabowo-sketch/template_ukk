@extends('layouts.app')

@section('title', 'Lending')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('lendings.create') }}" class="btn btn-primary">
        + Tambah Lending
    </a>
</div>

<table id="lendingTable">
    <thead>
        <tr>
            <th>no</th>
            <th>Name</th>
            <th>Staff</th>
            <th>Item</th>
            <th>Description</th>
            <th>Amount Borrowed</th>
            <th>Status</th>
            <th>Borrowed At</th>
            <th>Returned At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lendings as $lending)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $lending->name }}</td>
                <td>{{ $lending->user->name }}</td>
                <td>{{ $lending->item->name }}</td>
                <td>{{ $lending->description }}</td>
                <td>{{ $lending->amount_borrowed }}</td>
                <td>{{ $lending->status }}</td>
                <td>{{ $lending->created_at->format('d/m/Y') }}</td>
                <td>{{ $lending->returned_at ? $lending->returned_at->format('d/m/Y') : '-' }}</td>
                <td>
                    <div class="d-flex gap-2">
                        @if($lending->status === 'borrowed')
                            <form action="{{ route('lendings.return', $lending->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Mark as returned?')">Return</button>
                            </form>
                        @endif

                        <form action="{{ route('lendings.destroy', $lending->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
$(document).ready(function () {
    $('#lendingTable').DataTable();
});
</script>
@endsection
