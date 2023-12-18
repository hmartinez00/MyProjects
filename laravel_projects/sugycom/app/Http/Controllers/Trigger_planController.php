<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class Trigger_planController extends Controller
{
    public function index($starttime = null, $endtime = null): View
    {
        return view('trigger.index', [
            'starttime' => $starttime,
            'endtime' => $endtime,
        ]);
    }

    public function update(Request $request)
    {
        $starttime = $request->starttime;
        $endtime = $request->endtime;

        return redirect()->route('trigger.index', [
            'starttime' => $starttime,
            'endtime' => $endtime,
        ]);
    }
}
