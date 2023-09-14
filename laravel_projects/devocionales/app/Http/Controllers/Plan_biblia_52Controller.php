<?php

namespace App\Http\Controllers;

use App\Models\Plan_biblia_52;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class Plan_biblia_52Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plan_biblia_52s = Plan_biblia_52::all();
        $headers = Schema::getColumnListing('plan_biblia_52s');
        return view('plan_biblia_52.index', compact('plan_biblia_52s', 'headers'));
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
