<?php

namespace App\Http\Controllers;

use App\Models\StandardForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class WebsiteHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($lang = null)
    {
        if (!$lang) {
            $lang = config('app.fallback_locale');
        }
        App::setLocale($lang);

        $standardForms = StandardForm::latest()->get();
        return view('welcome', compact('standardForms'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
