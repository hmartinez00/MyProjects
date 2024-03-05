<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;

class NoteController extends Controller
{

    public function __construct()
    {
        $this->indices_0                = [0, 1, 2, 3, 4];
        $this->text_index_0             = [1, 2, 3, 4, 5];
        $this->datetime_local_index_0   = [6, 7, 8];
        $this->views_category           = 'note';
        $this->db_table                 = 'notes';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $items = Note::all();
        $views_category = $this->views_category;
        return view($views_category . '.index', compact('items', 'views_category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $views_category = $this->views_category;
        $headers = Schema::getColumnListing($this->db_table);
        return view($views_category . '.create', compact('views_category', 'headers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Note::create($request->all());
        $views_category = $this->views_category;
        return redirect()->route($views_category . '.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note): View
    {
        $data_item = $note;
        $views_category = $this->views_category;
        $headers = Schema::getColumnListing($this->db_table);
        return view($views_category . '.show', compact('data_item', 'views_category', 'headers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note): View
    {
        $data_item = $note;
        $views_category = $this->views_category;
        $headers = Schema::getColumnListing($this->db_table);
        return view($views_category . '.edit', compact('data_item', 'views_category', 'headers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note): RedirectResponse
    {
        $data_item = $note;
        $views_category = $this->views_category;
        $data_item->update($request->all());
        return redirect()->route($views_category . '.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note): RedirectResponse
    {
        $note->delete();
        $views_category = $this->views_category;
        return redirect()->route('note.index');
    }
}
