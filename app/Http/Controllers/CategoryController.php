<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = \App\Models\Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create() {
        $divisions = \App\Models\Division::all();
        return view('categories.create', compact('divisions'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
        ]);

        \App\Models\Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id) {
        $category = \App\Models\Category::findOrFail($id);
        $divisions = \App\Models\Division::all();
        return view('categories.edit', compact('category', 'divisions'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
        ]);

        $category = \App\Models\Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id) {
        $category = \App\Models\Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
