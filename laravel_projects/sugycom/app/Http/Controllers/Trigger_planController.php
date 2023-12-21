<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class Trigger_planController extends Controller
{
    public function index($stat = null): View
    {
        return view('trigger.index', compact('stat'));
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
            $json = array("starttime" => $starttime, "endtime" => $endtime, "date" => null, "rootes" => null);
            file_put_contents($directorio . "/data_trigger.json", json_encode($json));

        } else {

            // Actualiza las claves starttime y endtime en el archivo JSON
            $json = json_decode(file_get_contents($directorio . "/data_trigger.json"));
            $json->starttime = $starttime;
            $json->endtime = $endtime;
            // file_put_contents($directorio . "/data_trigger.json", json_encode($json));
            // Actualizamos la clave con los enrutamientos en el json
            if ($starttime === null && $endtime === null){
                $json->rootes = null;
            } else {               
                $rootes = shell_exec('python F:\MyProjects\laravel_projects\sugycom\py_scripts\trigger\rooting.py');
                // $json->rootes = $rootes;
                $json->rootes = json_decode($rootes, true);
            }
            file_put_contents($directorio . "/data_trigger.json", json_encode($json));
        }

        // Create a for loop that iterates over the dates between the start and end dates.
        $dates = [];
        for ($i = $starttime; $i <= $endtime; $i = date('Y-m-d', strtotime($i . ' + 1 day'))) {

            // Add the date to the list.
            $dates[] = $i;
            $json->date = $i;
            file_put_contents($directorio . "/data_trigger.json", json_encode($json));
            $output = shell_exec('python F:\MyProjects\laravel_projects\sugycom\py_scripts\trigger\generar_batchid.py');
            $stat = implode(', ', $dates). PHP_EOL;
        }

        return view('trigger.index', compact('stat'));
    }
}
