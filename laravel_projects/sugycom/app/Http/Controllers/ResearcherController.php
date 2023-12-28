<?php

namespace App\Http\Controllers;

use App\Models\Researcher;
// use App\Models\Priority;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;

class ResearcherController extends Controller
{
    public function __construct()
    {
        $this->indices_0 = [0, 1, 2, 3, 4];
        $this->$text_index_0 = [1, 2, 3, 4, 5];
        $this->indices_0 = [0, 1, 2, 3, 4];
        $this->indices_0 = [0, 1, 2, 3, 4];
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $items = Researcher::all();
        $indices = $this->indices_0;
        $headers = Schema::getColumnListing('researchers');
        $s_headers = array_intersect_key($headers, array_flip($indices));
        return view('researcher.index', compact('items', 's_headers'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $headers = Schema::getColumnListing('researchers');
        $text_index = $datetime_local_index;
        $datetime_local_index = [6, 7, 8];
        $headers_text = array_intersect_key($headers, array_flip($text_index));
        $headers_datetime_local = array_intersect_key($headers, array_flip($datetime_local_index));
        return view('researcher.create', compact('headers', 'headers_text', 'headers_datetime_local'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        Researcher::create($request->all());
        return redirect()->route('researcher.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Researcher $researcher): View
    {
        $headers = Schema::getColumnListing('researchers');
        return view('researcher.show', compact('researcher', 'headers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Researcher $researcher): View
    {
        $headers = Schema::getColumnListing('researchers');
        $text_index = $datetime_local_index;
        $datetime_local_index = [6, 7, 8];
        $headers_text = array_intersect_key($headers, array_flip($text_index));
        $headers_datetime_local = array_intersect_key($headers, array_flip($datetime_local_index));
        return view('researcher.edit', compact('researcher', 'headers', 'headers_text', 'headers_datetime_local'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Researcher $researcher): RedirectResponse
    {
        $researcher->update($request->all());
        return redirect()->route('researcher.show', $researcher->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Researcher $researcher): RedirectResponse
    {
        $researcher->delete();
        return redirect()->route('researcher.index');
    }
}
