<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $priorities = Priority::all();
        $headers = Schema::getColumnListing('priorities');
        $indices = [0, 1, 2, 9, 11];
        $selectedHeaders = array_intersect_key($headers, array_flip($indices));
        return view('priority.index', compact('priorities', 'selectedHeaders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('priority.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        Priority::create($request->all());
        return redirect()->route('priority.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Priority $priority): View
    {
        $headers = Schema::getColumnListing('priorities');
        return view('priority.show', compact('priority', 'headers'));
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
    public function destroy(Priority $priority):RedirectResponse
    {
        $priority->delete();
        return redirect()->route('priority.index');
    }
}
