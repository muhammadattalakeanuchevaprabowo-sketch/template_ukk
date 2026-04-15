<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index() {
        $items = \App\Models\Item::all();
        return view('items.index', compact('items'));
    }

    public function create() {
        $categories = \App\Models\Category::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'total' => 'required|integer|min:0'
        ]);

        \App\Models\Item::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'total' => $request->total,
        ]);
        return redirect()->route('items.index');
    }

    public function edit($id) {
        $item = \App\Models\Item::findOrFail($id);
        $categories = \App\Models\Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, $id) {
        $item = \App\Models\Item::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'total' => 'nullable|integer|min:0',
            'broke_count' => 'nullable|integer|min:0'
        ]);

        if ($request->broke_count > $item->total) {
            return redirect()->back()->withErrors(['broke_count' => 'Jumlah barang rusak tidak boleh melebihi total barang.'])->withInput();
        }

        $item->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'total' => $request->total,
            'broke_count' => $request->broke_count + $item->broke_count,
        ]);

        return redirect()->route('items.index');
    }

    public function exportExcel() {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\ItemExport, 'items.xlsx');
    }

    public function destroy ($id) {
        $item = \App\Models\Item::findOrFail($id);
        $item->delete();

        return redirect()->route('items.index');
    }
}
