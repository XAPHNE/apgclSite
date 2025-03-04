<?php

namespace App\Http\Controllers;

use App\Models\Act;
use App\Models\Policy;
use App\Models\ServiceRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ActsPoliciesServiceRulesController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $acts = Act::latest()->get();
        $policies = Policy::latest()->get();
        $serviceRules = ServiceRule::latest()->get();
        return view('website.documents.acts-policies-service-rules', compact('acts','policies','serviceRules'));
    }
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
