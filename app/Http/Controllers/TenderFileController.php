<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use App\Models\TenderFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TenderFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Validate the request
        $request->validate([
            'tender_id' => 'required|exists:tenders,id', // Ensure tender exists
            'name' => 'required|string|max:255',
            'downloadLink' => 'required|file|max:10240', // Optional: Limit file size to 10MB
        ]);

        // Find the tender
        $tender = Tender::findOrFail($request->tender_id);

        // Define the file path
        $year = $tender->financialYear->year;
        $directoryName = $tender->directory_name;

        // Ensure the directory exists (create it if necessary)
        $targetDirectory = public_path("admin-assets/Tenders/{$year}/{$directoryName}");
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }

        if ($request->hasFile('downloadLink')) {
            // Generate a unique file name
            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();

            // Move the file to the target directory
            $request->file('downloadLink')->move($targetDirectory, $fileName);

            // Set the full path for database storage
            $fullFilePath = "admin-assets/Tenders/{$year}/{$directoryName}/{$fileName}";
        } else {
            return redirect()->back()->withErrors(['downloadLink' => 'File upload failed.']);
        }

        // Save the tender file in the database
        TenderFile::create([
            'tender_id' => $tender->id,
            'name' => $request->name,
            'downloadLink' => $fullFilePath,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Tender File added successfully');
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
    public function update(Request $request, Tender $tender, TenderFile $tenderFile)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'downloadLink' => 'nullable|file|max:10240',
        ]);
    
        // Update logic
        $year = $tender->financialYear->year;
        $directoryName = $tender->directory_name;
        $targetDirectory = public_path("admin-assets/Tenders/{$year}/{$directoryName}");
    
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }
    
        $fullFilePath = $tenderFile->downloadLink; // Default to current file path
    
        if ($request->hasFile('downloadLink')) {
            // Delete the old file
            if (File::exists(public_path($tenderFile->downloadLink))) {
                File::delete(public_path($tenderFile->downloadLink));
            }
    
            // Upload the new file
            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $request->file('downloadLink')->move($targetDirectory, $fileName);
            $fullFilePath = "admin-assets/Tenders/{$year}/{$directoryName}/{$fileName}";
        }
    
        // Update tender file
        $tenderFile->update([
            'name' => $request->name,
            'downloadLink' => $fullFilePath,
        ]);
    
        return redirect()->route('tenders.show', $tender->id)->with('success', 'Tender File updated successfully');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tender $tender, TenderFile $tenderFile)
    {    
        // Check if the file exists and delete it
        if (File::exists(public_path($tenderFile->downloadLink))) {
            // File::delete(public_path($tenderFile->downloadLink));
        }
    
        // Delete the tender file record from the database
        $tenderFile->delete();
    
        // Redirect back with success message
        return redirect()->route('tenders.show', $tender->id)->with('success', 'Tender File deleted successfully');
    }
    
}
