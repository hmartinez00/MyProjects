<?php

namespace App\Http\Controllers;

use App\Models\Plan_biblia_52;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class Plan_biblia_52Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $plan_biblia_52s = Plan_biblia_52::all();
        $headers = Schema::getColumnListing('plan_biblia_52s');
        $indices = range(0, 5);
        $s_headers = array_intersect_key($headers, array_flip($indices));
        return view('plan_biblia_52.index', compact('plan_biblia_52s', 's_headers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $headers = Schema::getColumnListing('plan_biblia_52s');
        $text_index = [2, 3, 4, 5];
        $datetime_local_index = [1, 6, 7];
        $headers_text = array_intersect_key($headers, array_flip($text_index));
        $headers_datetime_local = array_intersect_key($headers, array_flip($datetime_local_index));
        return view('plan_biblia_52.create', compact('headers', 'headers_text', 'headers_datetime_local'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        Plan_biblia_52::create($request->all());
        return redirect()->route('plan_biblia_52.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan_biblia_52 $plan_biblia_52): View
    {
        $headers = Schema::getColumnListing('plan_biblia_52s');
        return view('plan_biblia_52.show', compact('plan_biblia_52', 'headers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan_biblia_52 $plan_biblia_52): View
    {
        $headers = Schema::getColumnListing('plan_biblia_52s');
        $text_index = [2, 3, 4, 5];
        $datetime_local_index = [1, 6, 7];
        $headers_text = array_intersect_key($headers, array_flip($text_index));
        $headers_datetime_local = array_intersect_key($headers, array_flip($datetime_local_index));
        return view('plan_biblia_52.edit', compact('plan_biblia_52', 'headers', 'headers_text', 'headers_datetime_local'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan_biblia_52 $plan_biblia_52): RedirectResponse
    {
        $plan_biblia_52->update($request->all());
        return redirect()->route('plan_biblia_52.show', $plan_biblia_52->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan_biblia_52 $plan_biblia_52): RedirectResponse
    {
        $plan_biblia_52->delete();
        return redirect()->route('plan_biblia_52.index');
    }
}
