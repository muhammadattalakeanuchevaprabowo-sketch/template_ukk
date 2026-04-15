<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index() {
        $divisions = \App\Models\Division::all();
        return view('divisions.index', compact('divisions'));
    }

    public function create() {
        return view('divisions.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        \App\Models\Division::create($request->all());

        return redirect()->route('divisions.index')->with('success', 'Division created successfully.');
    }

    public function edit($id) {
        $division = \App\Models\Division::findOrFail($id);
        return view('divisions.edit', compact('division'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $division = \App\Models\Division::findOrFail($id);
        $division->update($request->all());

        return redirect()->route('divisions.index')->with('success', 'Division updated successfully.');
    }

    public function destroy($id) {
        $division = \App\Models\Division::findOrFail($id);
        $division->delete();

        return redirect()->route('divisions.index')->with('success', 'Division deleted successfully.');
    }
}
