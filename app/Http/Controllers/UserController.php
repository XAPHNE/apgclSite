<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function assignRoles(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'array|required',
            'roles.*' => 'exists:roles,name',
        ]);

        $user->syncRoles($request->roles);

        return redirect()->back()->with('success', 'Roles assigned to user successfully.');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->latest()->get();
        $roles = Role::latest()->get();
        $departments = User::$departments;
        return view('admin.users', compact('users', 'roles', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:10',
                'confirmed',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'department' => 'required|string|in:' . implode(',', User::$departments),
            'must_change_passwd' => 'nullable|boolean',
        ]);

        User::create([
            'name' => ucwords(strtolower($request->name)),
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'department' => $request->department,
            'must_change_passwd' => $request->boolean('must_change_passwd'),
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'User added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => [
                'nullable',
                'string',
                'min:10',
                'confirmed',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'department' => 'required|string|in:' . implode(',', User::$departments),
            'must_change_passwd' => 'required|boolean',
        ]);

        $user->update([
            'name' => ucwords(strtolower($request->name)),
            'email' => $request->email,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
            'department' => $request->department,
            'must_change_passwd' => $request->boolean('must_change_passwd'),
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->deleted_by = auth()->id();
        $user->save();

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
