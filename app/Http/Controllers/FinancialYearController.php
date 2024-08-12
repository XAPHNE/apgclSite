<?php

namespace App\Http\Controllers;

use App\Models\FinancialYear;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FinancialYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FinancialYear::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<button class="btn btn-warning edit-button" data-id="'.$row->id.'"><i class="fas fa-edit"></i></button>';
                    $btn .= ' <button class="btn btn-danger delete-button" data-id="'.$row->id.'"><i class="fas fa-trash-alt"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view('admin.financial-years');
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
            'year' => 'required|string|max:255',
        ]);
    
        // Create the financial year record
        $financialYear = FinancialYear::create($request->all());
    
        // Create the directory in the public/tenders directory
        $directoryName = 'tenders_' . str_replace(' ', '_', $request->year);
        $directoryPath = public_path('admin-assets/tenders/' . $directoryName);
    
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true); // Create directory with read/write/execute permissions
        }
    
        return response()->json(['success' => 'Financial Year added successfully, and directory created.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $financialYear = FinancialYear::find($id);
        return response()->json($financialYear);
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
        $request->validate([
            'year' => 'required|string|max:255',
        ]);

        $financialYear = FinancialYear::findOrFail($id);
        $financialYear->update($request->all());

        return response()->json(['success' => 'Financial Year updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        FinancialYear::destroy($id);
        return response()->json(['success' => 'Financial Year deleted successfully.']);
    }
}
