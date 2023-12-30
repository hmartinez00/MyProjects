<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use File;
use App\Models\Setting;


class Trigger_planController extends Controller
{

    public function __construct()
    {
        // $this->test = Setting::find(2)->route;
        // $this->directorio_0 = 'F:/MyProjects/laravel_projects/sugycom/py_scripts';
        $this->directorio = Setting::find(1)->route;
        $this->directorio_0 = Setting::find(2)->route;
        $this->rootes_json = $this->directorio_0 . "/rootes.json";
        $this->data_trigger_json = $this->directorio_0 . "/data_trigger.json";
        $this->rooting_py = $this->directorio_0 . '/trigger/rooting.py';
        $this->generar_TCPLAN_py = $this->directorio_0 . '/trigger/generar_TCPLAN.py';
        $this->generar_batchid_py = $this->directorio_0 . '/trigger/generar_batchid.py';
        $this->compress_py = $this->directorio_0 . '/trigger/compress.py';
    }

    public function index(): View
    {   
        // $test = $this->test;
        // if (file_exists($this->rootes_json)) {
        //     $directoryData = json_decode(file_get_contents($this->rootes_json));
        //     if ($directoryData->plans !== null){
        //         $directories = scandir($directoryData->plans, 1);                
        //         $files = File::allFiles($directoryData->plans);               
        //     } else {
        //         $directories = [];
        //         $files = [];
        //     }
        // }

        $directories = scandir($this->directorio, 1);

        // return view('trigger.index', compact('test', 'directories', 'files'));
        // return view('trigger.index', compact('directories', 'files'));
        return view('trigger.index', compact('directories'));
    }

    public function sender(): View
    {   
        if (file_exists($this->rootes_json)) {
            $directoryData = json_decode(file_get_contents($this->rootes_json));
            if ($directoryData->plans !== null){
                $directories = scandir($directoryData->plans, 1);                
                $files = File::allFiles($directoryData->plans);               
            } else {
                $directories = [];
                $files = [];
            }
        }

        return view('trigger.sender', compact('directories', 'files'));
    }

    public function trigger(Request $request)
    {
        $starttime = $request->starttime;
        $endtime = $request->endtime;

        // Comprueba si el archivo existe
        if (!file_exists($this->data_trigger_json)) {

            // Crea el archivo JSON
            $json = array("starttime" => $starttime, "endtime" => $endtime, "date" => null);
            file_put_contents($this->$data_trigger_json, json_encode($json));

        } else {

            // Actualiza las claves starttime y endtime en el archivo JSON
            $json = json_decode(file_get_contents($this->data_trigger_json));
            $json->starttime = $starttime;
            $json->endtime = $endtime;
            $json->date = null;
        }

        // Comprueba si el archivo existe
        if (!file_exists($this->rootes_json)) {

            // Crea el archivo JSON
            $json2 = array("database" => null, "compendium" => null, "missions" => null, "plans" => null);
            file_put_contents($this->rootes_json, json_encode($json2));

        } else {
            if ($starttime === null || $endtime === null){

                $json2 = array("database" => null, "compendium" => null, "missions" => null, "plans" => null);
                file_put_contents($this->rootes_json, json_encode($json2));   

            } else {
                shell_exec('python ' . $this->rooting_py);
                shell_exec('python ' . $this->generar_TCPLAN_py);
            }
        }
        
        // Create a for loop that iterates over the dates between the start and end dates.
        $dates = [];
        for ($i = $starttime; $i <= $endtime; $i = date('Y-m-d', strtotime($i . ' + 1 day'))) {
            
            // Add the date to the list.
            $dates[] = $i;
            $json->date = $i;
            file_put_contents($this->data_trigger_json, json_encode($json));
            $output = shell_exec('python ' . $this->generar_batchid_py);
        }

        if ($starttime === null || $endtime === null){
            return redirect()->route('trigger.index');
        } else {
            return redirect()->route('trigger.sender');
        }
    }

    public function compress(){
        if (file_exists($this->rootes_json)) {
            $json = json_decode(file_get_contents($this->rootes_json));
            if ($json->plans !== null){
                shell_exec('python ' . $this->compress_py);
            }
        }

        // return redirect()->route('trigger.index');
        return redirect()->route('trigger.sender');
    }
}
