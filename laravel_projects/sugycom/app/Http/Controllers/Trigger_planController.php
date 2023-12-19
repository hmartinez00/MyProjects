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

    public function update(Request $request)
    {
        $starttime = $request->starttime;
        $endtime = $request->endtime;

        $stat = $starttime . ' | ' . $endtime;

        return view('trigger.index', compact('stat'));
    }
}
