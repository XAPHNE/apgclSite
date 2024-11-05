<?php

namespace App\Http\Controllers;

use App\Models\TariffOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class TariffOrderController extends Controller
{
    public function websiteIndex(Request $request, $lang)
    {
        App::setLocale($lang);
        $tariffOrders = TariffOrder::latest()->get();
        return view('website.documents.tariff-orders', compact('tariffOrders'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tariffOrders = TariffOrder::latest()->get();
        return view('admin.documents.tariff-order', compact('tariffOrders'));
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
            'description' => 'required|string',
            'downloadLink' => 'required|file',
            'visibility' => 'nullable|boolean',
            'news_n_events' => 'nullable|boolean',
            'new_badge' => 'nullable|boolean',
        ]);

        if ($request->hasFile('downloadLink')) {
            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Documents/Tariffs/Tariff Orders/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Documents/Tariffs/Tariff Orders/'), $fileName);
        }

        TariffOrder::create([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
        ]);

        return redirect()->back()->with('success', 'Tariff order added successfully');
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
        $tariffOrder = TariffOrder::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'downloadLink' => 'nullable|file',
            'visibility' => 'nullable|boolean',
            'news_n_events' => 'nullable|boolean',
            'new_badge' => 'nullable|boolean',
        ]);

        if ($request->hasFile('downloadLink')) {
            if (File::exists(public_path($tariffOrder->downloadLink))) {
                File::delete(public_path($tariffOrder->downloadLink));
            }

            $fileName = time() . '_' . $request->file('downloadLink')->getClientOriginalName();
            $filePath = 'admin-assets/Documents/Tariffs/Tariff Orders/' . $fileName;
            $request->file('downloadLink')->move(public_path('admin-assets/Documents/Tariffs/Tariff Orders/'), $fileName);
        } else {
            $filePath = $tariffOrder->downloadLink;
        }

        $tariffOrder->update([
            'name' => $request->name,
            'description' => $request->description,
            'downloadLink' => $filePath,
            'visibility' => $request->boolean('visibility'),
            'news_n_events' => $request->boolean('news_n_events'),
            'new_badge' => $request->boolean('new_badge'),
        ]);

        return redirect()->back()->with('success', 'Tariff order updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tariffOrder = TariffOrder::findOrFail($id);

        if (File::exists(public_path($tariffOrder->downloadLink))) {
            File::delete(public_path($tariffOrder->downloadLink));
        }

        $tariffOrder->delete();

        return redirect()->back()->with('success', 'Tariff order deleted successfully');
    }
}
