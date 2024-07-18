<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Report::get();

        if ($request->ajax()) {

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {

                    $btn = '<button data-id="' . $data->id . '" class="edit btn btn-primary btn-sm editBtn">
                           <span class="icon-bg"><i class="fas fa-edit"></i></span>
                           </button>';

                    if (Auth::check() && Auth::user()->admin == '1') {

                            $btn .= ' <button data-id="' . $data->id . '" class="btn btn-danger btn-sm  deleteBtn">
                               <span class="icon-bg"><i class="fas fa-trash-alt"></i></span>
                               </button>';
    
                        }

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.documents.report', compact('data'));
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
        $validator = Validator::make($request->all(),[

            'description' => 'required',
            'uploadFile' => 'required'

        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->all()]);//->toArray()]);
       }else{


        //store data in database
        $report = new Report;
        $report->description = $request->input('description');
        if ($request->hasfile('uploadFile')) {
            $file = $request->file('uploadFile');
            $fileName = time() . '_' . $request->uploadFile->getClientOriginalName();
            $fileAddress = public_path('/admin-assets/Document/Report');
            $file->move($fileAddress, $fileName);
            $report->downloadLink = '/admin-assets/Document/Report' . '/' . $fileName;
        }
        $query = $report ->save();

       if($query){
            return response()->json(['code'=>1,'msg'=>'Data submitted successfully']);
        }else{
            return response()->json(['code'=>2,'msg'=>'Something went wrong']);
        }
      
       }
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
        $report = Report::find($id);
        return response()->json([
            'status' => 200,
            'report' => $report,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[

            'editDescription' => 'required',
            // 'edituploadFile' => 'required'

        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->all()]);//->toArray()]);
       }else{


        //store data in database
        $report = Report::find($request->reportID);
        $report->description = $request->input('editDescription');
        if ($request->hasfile('edituploadFile')) {
            $file = $request->file('edituploadFile');
            $fileName = time() . '_' . $request->edituploadFile->getClientOriginalName();
            $fileAddress = public_path('/admin-assets/Document/Report');
            $file->move($fileAddress, $fileName);
            $report->downloadLink = '/admin-assets/Document/Report' . '/' . $fileName;
            unlink(public_path($request->input('fileLink')));
        }
        $query = $report ->update();

       if($query){
            return response()->json(['code'=>1,'msg'=>'Data submitted successfully']);
        }else{
            return response()->json(['code'=>2,'msg'=>'Something went wrong']);
        }
      
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $report = Report::find($id);
        $file = Report::where('id', $id)->pluck('downloadLink')->first();
        unlink(public_path($file));
        $report->delete();
    }
}
