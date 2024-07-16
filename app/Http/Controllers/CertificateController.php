<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $data = certificate::get();

        if ($request->ajax()) {

            return Datatables::of($data)
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

        return view('admin.documents.certificates', compact('data'));
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
            'downloadLink' => 'required'


        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->all()]);//->toArray()]);
       }else{


        $certificate = new Certificate;
        $certificate->description = $request->input('description');
        if ($request->hasfile('downloadLink')) {

            $this->validate($request, [
                'downloadLink' => 'required',
            ]);

            $file = $request->file('downloadLink');
            $fileName = time() . '_' . $request->downloadLink->getClientOriginalName();
            $fileAddress = public_path('/admin-assets/Document/certificate');
            $file->move($fileAddress, $fileName);
            $certificate->downloadLink = '/admin-assets/Document/certificate' . '/' . $fileName;
        }

       $query = $certificate->save();

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
        $certificate = Certificate::find($id);
        return response()->json([
            'status' => 200,
            'certificate' => $certificate,
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
            // 'editDownloadLink' => 'required'


        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->all()]);//->toArray()]);
       }else{


        $certificate = Certificate::find($request->certificateID);
        $certificate->description = $request->input('editDescription');
        if ($request->hasfile('editDownloadLink')) {

            $this->validate($request, [
                'editDownloadLink' => 'required',
            ]);

            $file = $request->file('editDownloadLink');
            $fileName = time() . '_' . $request->editDownloadLink->getClientOriginalName();
            $fileAddress = public_path('/Document/certificate');
            $file->move($fileAddress, $fileName);
            $certificate->downloadLink = '/Document/certificate' . '/' . $fileName;
            unlink(public_path($request->input('fileLink')));
        }

       $query = $certificate ->update();

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
        $certificate = certificate::find($id);
        $file = certificate::where('id', $id)->pluck('downloadLink')->first();
        unlink(public_path($file));
        $certificate->delete();

    }
}
