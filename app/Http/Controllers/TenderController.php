<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TenderController extends Controller
{
    public function index(Request $request)
    {

        $year = DB::table('financial_years')
            ->orderBy('year', 'desc')
            ->value('year');

        if (Auth::user()->admin == '1') {
            $data = Tender::where('financialYear', $year)
                ->where('archived', 0)
                ->get();
        } else {
            $data = Tender::where('financialYear', $year)
                ->where('archived', 0)
                ->where('department', Auth::user()->department)
                ->get();
        }

        if ($request->ajax()) {

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {

                    $btn = '<button data-id="' . $data->id . '" class="edit btn btn-primary btn-sm editBtn">
                           <span class="icon-bg"><i class="mdi mdi-border-color menu-icon"></i></span>
                           </button>';

                    if (Auth::check() && Auth::user()->admin == '1') {

                        $btn .= ' <button data-id="' . $data->id . '" class="btn btn-danger btn-sm  deleteBtn">
                           <span class="icon-bg"><i class="mdi mdi-delete menu-icon"></i></span>
                           </button>';

                    }

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.tenders.index', compact('data'));
    }
}
