<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use File;


class Trigger_planController extends Controller
{
    public function index($files = null): View
    {
        $directorio = 'F:\MyProjects\laravel_projects\sugycom\py_scripts';
    
        if (file_exists($directorio . "/rootes.json")) {
            $directoryData = json_decode(file_get_contents($directorio . "/rootes.json"));
            if ($directoryData->plans !== null){
                // $files = File::allFiles($directoryData->plans);
                // $files = [];
                // foreach (scandir($directoryData->plans) as $elemento) {
                //     if (is_dir($directoryData->plans . DIRECTORY_SEPARATOR . $elemento)) {
                //         $files[] = $elemento;
                //     }
                // }
                $files = scandir($directoryData->plans, 1); 
                // $subcadena = $directoryData->plans;
                // $position = strlen($subcadena);
            } else {
                $files = [];
                // $position = 0;
            }
        }

        // return view('trigger.index', compact('files', 'position'));
        return view('trigger.index', compact('files'));
    }

    public function trigger(Request $request)
    {
        $starttime = $request->starttime;
        $endtime = $request->endtime;

        // Define the directory where the JSON file will be created.
        $directorio = 'F:\MyProjects\laravel_projects\sugycom\py_scripts';
        // Comprueba si el archivo existe
        if (!file_exists($directorio . "/data_trigger.json")) {

            // Crea el archivo JSON
            $json = array("starttime" => $starttime, "endtime" => $endtime, "date" => null);
            file_put_contents($directorio . "/data_trigger.json", json_encode($json));

        } else {

            // Actualiza las claves starttime y endtime en el archivo JSON
            $json = json_decode(file_get_contents($directorio . "/data_trigger.json"));
            $json->starttime = $starttime;
            $json->endtime = $endtime;
            $json->date = null;
        }

        // Comprueba si el archivo existe
        if (!file_exists($directorio . "/rootes.json")) {

            // Crea el archivo JSON
            $json2 = array("database" => null, "compendium" => null, "missions" => null, "plans" => null);
            file_put_contents($directorio . "/rootes.json", json_encode($json2));

        } else {
            if ($starttime === null || $endtime === null){

                $json2 = array("database" => null, "compendium" => null, "missions" => null, "plans" => null);
                file_put_contents($directorio . "/rootes.json", json_encode($json2));   

            } else {
                shell_exec('python F:\MyProjects\laravel_projects\sugycom\py_scripts\trigger\rooting.py');
                shell_exec('python F:\MyProjects\laravel_projects\sugycom\py_scripts\trigger\generar_TCPLAN.py');
            }
        }
        
        // Create a for loop that iterates over the dates between the start and end dates.
        $dates = [];
        for ($i = $starttime; $i <= $endtime; $i = date('Y-m-d', strtotime($i . ' + 1 day'))) {
            
            // Add the date to the list.
            $dates[] = $i;
            $json->date = $i;
            file_put_contents($directorio . "/data_trigger.json", json_encode($json));
            $output = shell_exec('python F:\MyProjects\laravel_projects\sugycom\py_scripts\trigger\generar_batchid.py');
        }

        return redirect()->route('trigger.index');
    }

    public function compress(){
        $directorio = 'F:\MyProjects\laravel_projects\sugycom\py_scripts';
        if (file_exists($directorio . "/rootes.json")) {
            $json = json_decode(file_get_contents($directorio . "/rootes.json"));
            if ($directoryData->plans !== null){
                
            }
        }
    }
}
