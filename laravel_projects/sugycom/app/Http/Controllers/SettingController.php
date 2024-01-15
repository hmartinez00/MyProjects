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
        $this->directory        = 'F:/MyProjects/laravel_projects/sugycom/setting.json';
        $this->views_category   = 'setting';
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $views_category = $this->views_category;

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

        return view('setting.index', compact('views_category', 'dir', 'database_status', 'py_settings', 'py_scripts'));
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
        $views_category = $this->views_category;
        $param = $request->all();
        return redirect()->route($views_category . '.show', compact('param'));
    }

    /**
     * Display the specified resource.
     */
    public function show( $param = null ): View
    {
        $views_category = $this->views_category;
        return view($views_category . '.show', compact('views_category', 'param'));
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
    public function update(Request $request): RedirectResponse
    {
        $views_category = $this->views_category;
        $param = $request->all();
        
        $database_status = [];
        $dir = [];
        $py_settings = [];
        $py_scripts = [];
        foreach ( $param as $key => $value ){
            if ( strpos($key, 'database_status__') !== false ){
                $database_status[] = $value;
            }
            elseif ( strpos($key, 'dir__') !== false ){
                $dir[] = $value;
            }
            elseif ( strpos($key, 'py_settings__') !== false ){
                $py_settings[] = $value;
            }
            elseif ( strpos($key, 'py_scripts__') !== false ){
                $py_scripts[] = $value;
            }
        }

        $json = json_decode(file_get_contents($this->directory));
        $json->database_status = $database_status;
        $json->dir = $dir;
        $json->py_settings = $py_settings;
        $json->py_scripts = $py_scripts;
        file_put_contents($this->directory, json_encode($json, JSON_PRETTY_PRINT));

        return redirect()->route($views_category . '.index', compact('views_category'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting): RedirectResponse
    {

    }
}
