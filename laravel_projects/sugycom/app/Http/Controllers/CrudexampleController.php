<?php

namespace App\Http\Controllers;

use App\Models\Crudexample;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CrudexampleController extends Controller
{
    public function __construct()
    {
        $this->directory        = 'F:/MyProjects/laravel_projects/sugycom/setting.json';
        $directoryData          = json_decode(file_get_contents($this->directory));
        $dir                    = $directoryData->dir;
        $database_status        = $directoryData->database_status;
        $py_settings            = $directoryData->py_settings;
        $py_scripts             = $directoryData->py_scripts;

        $this->db_options_json  = $dir[1] . $py_settings[2];

        $this->indices_0                = [0, 1, 2, 3, 4];
        $this->text_index_0             = [1];
        $this->float_index_0            = [2];
        $this->datetime_local_index_0   = [4];
        $this->views_category           = 'crudexample';
        $this->db_table                 = 'crudexamples';

        $this->actions                  = $this->views_category . '.db_options';
        $this->export_py                = $dir[1] . $py_scripts[6]; #'/db_options/export.py';
        $this->import_py                = $dir[1] . $py_scripts[7]; #'/db_options/import.py';
        $this->reset_count_py           = $dir[1] . $py_scripts[8]; #'/db_options/reset_count.py';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $items  = Crudexample::all();
        $rows   = count($items);
        $start  = 1;
        if ( $rows > $start + 4 ){
            $end = $start + 4;
        } else {
            $end = $rows;
        }

        // Comprueba si el archivo existe
        if (!file_exists($this->db_options_json)) {
            // Crea el archivo JSON
            $json = array("db_table" => null, "start" => null, "end" => null);
            file_put_contents($this->db_options_json, json_encode($json, JSON_PRETTY_PRINT));

        } else {
            // Actualiza las claves db_table en el archivo JSON
            $json = json_decode(file_get_contents($this->db_options_json));
            if ( $json->db_table !== $this->db_table ){
                $json = array("db_table" => $this->db_table, "start" => $start, "end" => $end);
                file_put_contents($this->db_options_json, json_encode($json, JSON_PRETTY_PRINT));
            } else {
                $json   = json_decode(file_get_contents($this->db_options_json));
                $start  = $json->start;
                $end    = $json->end;
            }
        }

        $rowsList = array();
        for ($j = $start; $j <= $end; $j++) {
            $rowsList[] = $j;
        }

        $status = array(TRUE, TRUE);
        if ( $start - 1 < 1 ){
            $status[0] = FALSE;
        }
        if ( $end + 1 > $rows ) {
            $status[1] = FALSE;
        }

        $rowsList_2 = array();
        for ($j = 1; $j <= $rows; $j++) {
            $rowsList_2[] = $j;
        }

        $items = Crudexample::whereBetween('id', [$start, $end])->get();
        $views_category = $this->views_category;
        $actions = $this->actions;
        $indices = $this->indices_0;
        $headers = Schema::getColumnListing($this->db_table);
        $s_headers = array_intersect_key($headers, array_flip($indices));
        return view($views_category . '.index', compact('rowsList', 'rowsList_2', 'rows', 'start', 'end', 'items', 'views_category', 's_headers', 'actions', 'status'));
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
        shell_exec('python ' . $this->reset_count_py);
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

    public function step( $param = null )
    {
        $items  = Crudexample::all();
        $rows   = count($items);
        $start  = intval($param);
        if ( $rows > $start + 4 ){
            $end = $start + 4;
        } else {
            $end = $rows;
        }

        $rowsList = array();
        for ($j = $start; $j < $end; $j++) {
            $rowsList[] = $j;
        }

        $status = array(TRUE, TRUE);
        if ( $start - 1 < 1 ){
            $status[0] = FALSE;
        }
        if ( $end + 1 > $rows ) {
            $status[1] = FALSE;
        }

        $json = array("db_table" => $this->db_table, "start" => $start, "end" => $end);
        return array($json, $rowsList, $status);

    }

    public function show_rows( $param = null )
    {
        $views_category = $this->views_category;
        $actions = $this->actions;

        $values     = $this->step($param);

        $json       = $values[0];
        $rowsList   = $values[1];
        $status     = $values[2];
        file_put_contents($this->db_options_json, json_encode($json, JSON_PRETTY_PRINT));

        return redirect()->route($views_category . '.index', compact('actions', 'rowsList', 'status'));
    }

}