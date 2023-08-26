<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $priorities = Priority::all();
        return view('priority.index', compact('priorities'));
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
    public function show(Priority $priority): View
    {
        return view('priority.show', compact('priority'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Priority $priority): View
    {
        return view('priority.edit', compact('priority'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Priority $priority): RedirectResponse
    {
        $priority->update($request->all());
        return redirect()->route('priority.show', $priority->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
