<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('department');
            return DataTables::of($data)
                ->addColumn('action', function($data) {
                    return '<button class="btn btn-success edit-button" data-id="'.$data->id.'">Edit</button>' .
                           '<button class="btn btn-danger delete-button" data-id="'.$data->id.'">Delete</button>';
                })
                ->addColumn('roles', function($user) {
                    $roles = [];
                    if ($user->tender) $roles[] = 'Tender';
                    if ($user->newsEvent) $roles[] = 'News & Event';
                    if ($user->about) $roles[] = 'About Us';
                    if ($user->career) $roles[] = 'Career';
                    if ($user->document) $roles[] = 'Documents';
                    if ($user->disaster) $roles[] = 'Disaster Management';
                    if ($user->contact) $roles[] = 'Contact';
                    if ($user->corporate) $roles[] = 'Corporate Social Responsibility';
                    if ($user->calendar) $roles[] = 'Calendar & Holidays';
                    if ($user->dailyGeneration) $roles[] = 'Daily Generations';
                    if ($user->admin) $roles[] = 'Admin';
                    return implode(', ', $roles);
                })
                ->editColumn('department', function($data) {
                    return $data->department->department ?? 'No department';
                })
                ->rawColumns(['action', 'roles'])
                ->make(true);
        }
    
        $departments = Department::all();
        return view('admin.user-management', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('admin.user-management.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'department_id' => 'required|integer',
            'tender' => 'nullable|boolean',
            'newsEvent' => 'nullable|boolean',
            'about' => 'nullable|boolean',
            'career' => 'nullable|boolean',
            'document' => 'nullable|boolean',
            'disaster' => 'nullable|boolean',
            'contact' => 'nullable|boolean',
            'corporate' => 'nullable|boolean',
            'calendar' => 'nullable|boolean',
            'dailyGeneration' => 'nullable|boolean',
            'admin' => 'nullable|boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'department_id' => $request->department_id,
            'tender' => $request->tender ? 1 : 0,
            'newsEvent' => $request->newsEvent ? 1 : 0,
            'about' => $request->about ? 1 : 0,
            'career' => $request->career ? 1 : 0,
            'document' => $request->document ? 1 : 0,
            'disaster' => $request->disaster ? 1 : 0,
            'contact' => $request->contact ? 1 : 0,
            'corporate' => $request->corporate ? 1 : 0,
            'calendar' => $request->calendar ? 1 : 0,
            'dailyGeneration' => $request->dailyGeneration ? 1 : 0,
            'admin' => $request->admin ? 1 : 0,
        ]);

        return Redirect::route('user-management.index')->with('success', 'User registered successfully');
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
        $user = User::findOrFail($id);
        $departments = Department::all();
        return view('admin.user-management.edit', compact('user', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'department_id' => 'required|integer',
            'tender' => 'nullable|boolean',
            'newsEvent' => 'nullable|boolean',
            'about' => 'nullable|boolean',
            'career' => 'nullable|boolean',
            'document' => 'nullable|boolean',
            'disaster' => 'nullable|boolean',
            'contact' => 'nullable|boolean',
            'corporate' => 'nullable|boolean',
            'calendar' => 'nullable|boolean',
            'dailyGeneration' => 'nullable|boolean',
            'admin' => 'nullable|boolean',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'department_id' => $request->department_id,
            'tender' => $request->tender ? 1 : 0,
            'newsEvent' => $request->newsEvent ? 1 : 0,
            'about' => $request->about ? 1 : 0,
            'career' => $request->career ? 1 : 0,
            'document' => $request->document ? 1 : 0,
            'disaster' => $request->disaster ? 1 : 0,
            'contact' => $request->contact ? 1 : 0,
            'corporate' => $request->corporate ? 1 : 0,
            'calendar' => $request->calendar ? 1 : 0,
            'dailyGeneration' => $request->dailyGeneration ? 1 : 0,
            'admin' => $request->admin ? 1 : 0,
        ]);

        return Redirect::route('user-management.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        return Redirect::route('user-management.index')->with('success', 'User deleted successfully');
    }
}
