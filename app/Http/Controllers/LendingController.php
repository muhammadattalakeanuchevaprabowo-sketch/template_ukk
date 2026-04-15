<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LendingController extends Controller
{
    public function index() {
        $lendings = \App\Models\Lending::with('item', 'user')->get();
        return view('lendings.index', compact('lendings'));
    }

    public function create() {
        $items = \App\Models\Item::all();
        return view('lendings.create', compact('items'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'item_id' => 'required|exists:items,id',
            'amount_borrowed' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $item = \App\Models\Item::findOrFail($request->item_id);

        if ($item->getAvailableAttribute() < $request->amount_borrowed) {
            return redirect()->back()->withErrors(['stok' => 'Stok tidak cukup!']);
        }

        \App\Models\Lending::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'item_id' => $request->item_id,
            'amount_borrowed' => $request->amount_borrowed,
            'description' => $request->description,
            'status' => 'borrowed',
        ]);

        return redirect()->route('lendings.index')->with('success', 'Lending created successfully.');
    }
    public function return($id) {
        $lending = \App\Models\Lending::findOrFail($id);

        if ($lending->status === 'returned') {
            return redirect()->back();
        }

        // 1. Update status transaksi
        $lending->update([
            'status' => 'returned',
            'returned_at' => now()
        ]);

        return redirect()->route('lendings.index');
    }

    public function exportExcel() {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\LendingExport, 'lendings.xlsx');
    }

    public function destroy($id) {
        $lending = \App\Models\Lending::findOrFail($id);
        $item = $lending->item;

        $lending->delete();

        return redirect()->route('lendings.index');
    }
}
