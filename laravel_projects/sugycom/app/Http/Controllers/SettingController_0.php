<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->indices_0                = [1];
        $this->text_index_0             = [1];
        $this->datetime_local_index_0   = [2, 3];
        $this->views_category           = 'setting';
        $this->db_table                 = 'settings';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $items = Setting::all();
        $views_category = $this->views_category;
        $indices = $this->indices_0;
        $headers = Schema::getColumnListing($this->db_table);
        $s_headers = array_intersect_key($headers, array_flip($indices));
        return view($views_category . '.index', compact('items', 'views_category', 's_headers'));

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
        Setting::create($request->all());
        return redirect()->route($this->views_category . '.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting): View
    {
        $data_item = $setting;
        $views_category = $this->views_category;
        $headers = Schema::getColumnListing($this->db_table);
        return view($views_category . '.show', compact('data_item', 'views_category', 'headers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting): View
    {
        $data_item = $setting;
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
    public function update(Request $request, Setting $setting): RedirectResponse
    {
        $data_item = $setting;
        $views_category = $this->views_category;
        $data_item->update($request->all());
        return redirect()->route($views_category . '.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting): RedirectResponse
    {
        $setting->delete();
        return redirect()->route($this->views_category . '.index');
    }
}
