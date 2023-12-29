<?php

namespace App\Http\Controllers;

use App\Models\Researcher;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;

class ResearcherController extends Controller
{
    public function __construct()
    {
        $this->indices_0                = [0, 1, 2, 3, 4];
        $this->text_index_0             = [1, 2, 3, 4, 5];
        $this->datetime_local_index_0   = [6, 7, 8];
        $this->views_category           = 'researcher';
        $this->db_table                 = 'researchers';
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $items = Researcher::all();
        $indices = $this->indices_0;
        $headers = Schema::getColumnListing($this->db_table);
        $s_headers = array_intersect_key($headers, array_flip($indices));
        return view($this->views_category . '.index', compact('items', 's_headers'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $views_category = $this->views_category;
        $headers = Schema::getColumnListing($this->db_table);
        $text_index = $this->text_index_0;
        $datetime_local_index = $this->datetime_local_index_0;
        $headers_text = array_intersect_key($headers, array_flip($text_index));
        $headers_datetime_local = array_intersect_key($headers, array_flip($datetime_local_index));
        return view($views_category . '.create', compact('views_category', 'headers', 'headers_text', 'headers_datetime_local'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        Researcher::create($request->all());
        return redirect()->route($this->views_category . '.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Researcher $researcher): View
    {
        $data_item = $researcher;
        $views_category = $this->views_category;
        $headers = Schema::getColumnListing($this->db_table);
        return view($views_category . '.show', compact('data_item', 'views_category', 'headers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Researcher $researcher): View
    {
        $data_item = $researcher;
        $views_category = $this->views_category;
        $headers = Schema::getColumnListing($this->db_table);
        $text_index = $this->text_index_0;
        $datetime_local_index = $this->datetime_local_index_0;
        $headers_text = array_intersect_key($headers, array_flip($text_index));
        $headers_datetime_local = array_intersect_key($headers, array_flip($datetime_local_index));
        return view($views_category . '.edit', compact('data_item', 'views_category', 'headers', 'headers_text', 'headers_datetime_local'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Researcher $researcher): RedirectResponse
    {
        $researcher->update($request->all());
        return redirect()->route($this->views_category . '.show', $researcher->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Researcher $researcher): RedirectResponse
    {
        $researcher->delete();
        return redirect()->route($this->views_category . '.index');
    }
}
