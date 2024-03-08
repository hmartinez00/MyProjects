<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crudexample;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;

class CrudexampleController extends Controller
{

    public function __construct()
    {
        $this->indices_0                = [1, 2, 3, 4];
        $this->text_index_0             = [1];
        $this->float_index_0            = [2];
        $this->datetime_local_index_0   = [4];
        $this->views_category           = 'crudexample';
        $this->db_table                 = 'crudexamples';
        $this->directorio_0             = 'F:/MyProjects/laravel_projects/sugycom/py_scripts';
        $this->actions                  = 'backup_options';
        $this->export_py                = $this->directorio_0 . '/backup_options/export.py';
        $this->import_py                = $this->directorio_0 . '/backup_options/import.py';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $items = Crudexample::all();
        $views_category = $this->views_category;
        $actions = $this->actions;
        $indices = $this->indices_0;
        $headers = Schema::getColumnListing($this->db_table);
        $s_headers = array_intersect_key($headers, array_flip($indices));
        return view($views_category . '.index', compact('items', 'views_category', 's_headers', 'actions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $views_category = $this->views_category;
        $headers = Schema::getColumnListing($this->db_table);
        $text_index = $this->text_index_0;
        $float_index = $this->float_index_0;
        $datetime_local_index = $this->datetime_local_index_0;
        $headers_text = array_intersect_key($headers, array_flip($text_index));
        $headers_float = array_intersect_key($headers, array_flip($float_index));
        $headers_datetime_local = array_intersect_key($headers, array_flip($datetime_local_index));
        return view($views_category . '.create', compact('views_category', 'headers', 'headers_text', 'headers_float', 'headers_datetime_local'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Crudexample::create($request->all());
        $views_category = $this->views_category;
        $actions = $this->actions;
        return redirect()->route($views_category . '.index', compact('actions'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Crudexample $crudexample): View
    {
        $data_item = $crudexample;
        $views_category = $this->views_category;
        $headers = Schema::getColumnListing($this->db_table);
        return view($views_category . '.show', compact('data_item', 'views_category', 'headers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Crudexample $crudexample): View
    {
        $data_item = $crudexample;
        $views_category = $this->views_category;
        $headers = Schema::getColumnListing($this->db_table);
        $text_index = $this->text_index_0;
        $float_index = $this->float_index_0;
        $datetime_local_index = $this->datetime_local_index_0;
        $headers_text = array_intersect_key($headers, array_flip($text_index));
        $headers_float = array_intersect_key($headers, array_flip($float_index));
        $headers_datetime_local = array_intersect_key($headers, array_flip($datetime_local_index));
        return view($views_category . '.edit', compact('data_item', 'views_category', 'headers', 'headers_text', 'headers_float', 'headers_datetime_local'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Crudexample $crudexample): RedirectResponse
    {
        $data_item = $crudexample;
        $views_category = $this->views_category;
        $data_item->update($request->all());
        return redirect()->route($views_category . '.show', $data_item->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Crudexample $crudexample): RedirectResponse
    {
        $crudexample->delete();
        $views_category = $this->views_category;
        $actions = $this->actions;
        return redirect()->route($views_category . '.index', compact('actions'));
    }

    public function import()
    {
        $views_category = $this->views_category;
        $actions = $this->actions;
        shell_exec('python ' . $this->import_py);
        return redirect()->route($views_category . '.index', compact('actions'));
    }

    public function export()
    {
        $views_category = $this->views_category;
        $actions = $this->actions;
        shell_exec('python ' . $this->export_py);
        return redirect()->route($views_category . '.index', compact('actions'));
    }

}
