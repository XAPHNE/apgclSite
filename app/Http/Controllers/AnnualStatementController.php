<?php

namespace App\Http\Controllers;

use App\Models\AnnualStatement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AnnualStatementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $data = AnnualStatement::get();

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

        return view('admin.documents.annual-statement', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validator = Validator::make($request->all(),[

            'description' => 'required',
            'uploadFile' => 'required'

        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->all()]);//->toArray()]);
       }else{


        //store data in database
        $annualstatement = new AnnualStatement;
        $annualstatement->description = $request->input('description');
        if ($request->hasfile('uploadFile')) {
            $file = $request->file('uploadFile');
            $fileName = time() . '_' . $request->uploadFile->getClientOriginalName();
            $fileAddress = public_path('/admin-assets/Document/Annualstatement');
            $file->move($fileAddress, $fileName);
            $annualstatement->downloadLink = '/admin-assets/Document/Annualstatement' . '/' . $fileName;
        }
        $query = $annualstatement ->save();

       if($query){
            return response()->json(['code'=>1,'msg'=>'Data submitted successfully']);
        }else{
            return response()->json(['code'=>2,'msg'=>'Something went wrong']);
        }
      
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $annualstatement = AnnualStatement::find($id);
        return response()->json([
            'status' => 200,
            'annualstatement' => $annualstatement,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $validator = Validator::make($request->all(),[

            'editDescription' => 'required',
            // 'edituploadFile' => 'required'

        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->all()]);//->toArray()]);
       }else{


        //store data in database
        $annualstatement = AnnualStatement::find($request->annualstatementID);
        $annualstatement->description = $request->input('editDescription');
        if ($request->hasfile('edituploadFile')) {
            $file = $request->file('edituploadFile');
            $fileName = time() . '_' . $request->edituploadFile->getClientOriginalName();
            $fileAddress = public_path('/admin-assets/Document/Annualstatement');
            $file->move($fileAddress, $fileName);
            $annualstatement->downloadLink = '/admin-assets/Document/Annualstatement' . '/' . $fileName;
            unlink(public_path($request->input('fileLink')));
        }
        $query = $annualstatement ->update();

       if($query){
            return response()->json(['code'=>1,'msg'=>'Data submitted successfully']);
        }else{
            return response()->json(['code'=>2,'msg'=>'Something went wrong']);
        }
      
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $annualstatement = AnnualStatement::find($id);
        $file = AnnualStatement::where('id', $id)->pluck('downloadLink')->first();
        unlink(public_path($file));
        $annualstatement->delete();
    }
}
