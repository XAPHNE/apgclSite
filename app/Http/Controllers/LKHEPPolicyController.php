<?php

namespace App\Http\Controllers;

use App\Models\LKHEPPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class LKHEPPolicyController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $lkhepPolicies = LKHEPPolicy::latest()->get()->groupBy('name');
        return view('website.projects.ongoing-projects.lkhep', compact('lkhepPolicies'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $lkhepPolicies = LKHEPPolicy::latest()->get();
        return view('admin.projects.ongoing-projects.lkhep-policies', compact('lkhepPolicies'));
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
            'description' => 'nullable|string',
            'downloadLink' => 'required|file',
        ]);

        if ($request->hasFile('downloadLink')) {
            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Projects/Ongoing Projects/LKHEP Policies/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Projects/Ongoing Projects/LKHEP Policies/'), $fileName);
        }

        LKHEPPolicy::create([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
        ]);

        return redirect()->back()->with('success', 'LKHEP policy added successfully');
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
        $lkhepPolicy = LKHEPPolicy::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'downloadLink' => 'nullable|file',
        ]);

        if ($request->hasFile('downloadLink')) {
            if (File::exists(public_path($lkhepPolicy->downloadLink))) {
                File::delete(public_path($lkhepPolicy->downloadLink));
            }

            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Ongoing Projects/LKHEP Policies/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Ongoing Projects/LKHEP Policies/'), $fileName);
        } else {
            $filePath = $lkhepPolicy->downloadLink;
        }

        $lkhepPolicy->update([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
        ]);

        return redirect()->back()->with('success', 'LKHEP policy updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lkhepPolicy = LKHEPPolicy::findOrFail($id);

        if (File::exists(public_path($lkhepPolicy->downloadLink))) {
            // File::delete(public_path($lkhepPolicy->downloadLink));
        }

        $lkhepPolicy->delete();

        return redirect()->back()->with('success', 'LKHEP policy deleted successfully');
    }
}
