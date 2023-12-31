<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->directory = 'F:/MyProjects/laravel_projects/sugycom/setting.json';
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $directoryData = json_decode(file_get_contents($this->directory));
        
        $dir = $directoryData->dir;
        $database_status = $directoryData->database_status;
        $py_settings = $directoryData->py_settings;
        $py_scripts = $directoryData->py_scripts;

        $directoryData = [
            'dir' => $directoryData->dir,
            'database_status' => $directoryData->database_status,
            'py_settings' => $directoryData->py_settings,
            'py_scripts' => $directoryData->py_scripts
        ];

        return view('setting.index', compact('dir', 'database_status', 'py_settings', 'py_scripts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting): View
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting): View
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting): RedirectResponse
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting): RedirectResponse
    {

    }
}
