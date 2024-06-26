<?php

namespace App\Http\Controllers;

use App\Models\Researcher;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use TelegramBot\Api\BotApi;


class ResearcherController extends Controller
{
    public function __construct()
    {
        $this->directory        = 'F:/MyProjects/laravel_projects/sugycom/setting.json';
        $directoryData          = json_decode(file_get_contents($this->directory));
        $dir                    = $directoryData->dir;
        $database_status        = $directoryData->database_status;
        $py_settings            = $directoryData->py_settings;
        $py_scripts             = $directoryData->py_scripts;
        
        $this->telegram         = $directoryData->telegram;

        $this->db_options_json  = $dir[1] . $py_settings[2];

        $this->indices_0                = [0, 1, 2, 3, 4, 6];
        $this->text_index_0             = [1, 2, 3, 4, 5];
        $this->float_index_0            = [];
        $this->datetime_local_index_0   = [6, 7, 8];
        $this->views_category           = 'researcher';
        $this->db_table                 = 'researchers';

        $this->actions                  = $this->views_category . '.db_options';
        $this->export_py                = $dir[1] . '/db_options/export.py';
        $this->import_py                = $dir[1] . '/db_options/import.py';
        $this->reset_count_py           = $dir[1] . '/db_options/reset_count.py';

        $this->num_rows                 = 7;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $items  = Researcher::all();
        $rows   = count($items);
        $start  = 1;
        if ( $rows > $start + $this->num_rows ){
            $end = $start + $this->num_rows;
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

        $rowsList_dropdown = array();
        for ($j = 1; $j <= $rows; $j++) {
            $rowsList_dropdown[] = $j;
        }

        $items = Researcher::whereBetween('id', [$start, $end])->get();
        $views_category = $this->views_category;
        $actions = $this->actions;
        $indices = $this->indices_0;
        $headers = Schema::getColumnListing($this->db_table);
        $s_headers = array_intersect_key($headers, array_flip($indices));
        return view($views_category . '.index', compact('items', 'views_category', 's_headers', 'actions', 'status', 'rowsList', 'rowsList_dropdown'));
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
        Researcher::create($request->all());
        $views_category = $this->views_category;
        $actions = $this->actions;

        $values     = $this->step(1);

        $json       = $values[0];
        $rowsList   = $values[1];
        $status     = $values[2];
        file_put_contents($this->db_options_json, json_encode($json, JSON_PRETTY_PRINT));

        return redirect()->route($views_category . '.index', compact('actions', 'rowsList', 'status'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Researcher $Researcher): View
    {
        $data_item = $Researcher;
        $views_category = $this->views_category;
        $headers = Schema::getColumnListing($this->db_table);
        return view($views_category . '.show', compact('data_item', 'views_category', 'headers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Researcher $Researcher): View
    {
        $data_item = $Researcher;
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
    public function update(Request $request, Researcher $Researcher): RedirectResponse
    {
        $data_item = $Researcher;
        $views_category = $this->views_category;
        $data_item->update($request->all());
        return redirect()->route($views_category . '.show', $data_item->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Researcher $Researcher): RedirectResponse
    {
        $Researcher->delete();
        $views_category = $this->views_category;
        $actions = $this->actions;

        $values     = $this->step(1);

        $json       = $values[0];
        $rowsList   = $values[1];
        $status     = $values[2];
        file_put_contents($this->db_options_json, json_encode($json, JSON_PRETTY_PRINT));

        shell_exec('python ' . $this->reset_count_py);
        return redirect()->route($views_category . '.index', compact('actions', 'rowsList', 'status'));
    }

    /**
     * Import data from storage.
     */
    public function import(): RedirectResponse
    {
        $views_category = $this->views_category;
        $actions = $this->actions;
        shell_exec('python ' . $this->import_py);
        return redirect()->route($views_category . '.index', compact('actions'));
    }

    /**
     * Export data from storage.
     */
    public function export(): RedirectResponse
    {
        $views_category = $this->views_category;
        $actions = $this->actions;
        shell_exec('python ' . $this->export_py);
        return redirect()->route($views_category . '.index', compact('actions'));
    }

    /**
     * Auxiliar function for control of pages.
     */    
    public function step( $param = null )
    {
        $items  = Researcher::all();
        $rows   = count($items);
        $start  = intval($param);
        if ( $rows > $start + $this->num_rows ){
            $end = $start + $this->num_rows;
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

    /**
     * Limit rows shown.
     */
    public function show_rows( $param = null ): RedirectResponse
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

    /**
     * Special function to send the specified resource from storage by API's telegram.
     */
    public function sendTelegramMessage(Researcher $researcher): RedirectResponse
    {
        $items  = Researcher::all();
        $views_category = $this->views_category;
        $actions = $this->actions;
        $api_key = $this->telegram[0];
        $id = $this->telegram[1];
        
        $telegram = new BotApi($api_key);
        $chatId = $id;

        $text = $researcher;

        $telegram->sendMessage(
            $chatId,
            $text,
        );

        return redirect()->route($views_category . '.index', compact('actions'));        
    }

}
