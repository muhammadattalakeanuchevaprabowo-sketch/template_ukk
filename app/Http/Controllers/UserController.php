<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = \App\Models\User::all();
        return view('users.index', compact('users'));
    }

    public function index_operator() {
        $users = \App\Models\User::all();
        return view('users.operator', compact('users'));
    }

    public function resetPasswordAdmin($id) {
        $user = \App\Models\User::findOrFail($id);
        $emailPrefix = substr($user->email, 0, 4);
        $generatedPassword = $emailPrefix . $user->id;
        $user->update(['password' => bcrypt($generatedPassword)]);

        return redirect()->route('users.operator')->with('generatedPassword', $generatedPassword);
    }

    public function create() {
        return view('users.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|in:admin,staff',
        ]);

        $emailPrefix = substr($request->email, 0, 4);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('sementara'),
            'role' => $request->role,
        ]);

        $generatedPassword = $emailPrefix . $user->id;
        $user->update(['password' => bcrypt($generatedPassword)]);

        return redirect()->route('users.index')->with('generatedPassword', $generatedPassword)->with('success', 'User created successfully.');
    }

    public function edit($id) {
        $user = \App\Models\User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:admin,staff',
            'password' => 'nullable|string|min:8',
        ]);

        $user = \App\Models\User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function exportExcel() {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\UsersExport, 'users.xlsx');
    }

    public function destroy($id) {
        $user = \App\Models\User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
