<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class Trigger_planController extends Controller
{
    public function index($starttime = null): View
    {
        return view('trigger.index', [
            'starttime' => $starttime,
        ]);
    }

    public function update(Request $request)
    {
        $starttime = $request->starttime;

        return redirect()->route('trigger.index', [
            'starttime' => $starttime,
        ]);
    }
}
