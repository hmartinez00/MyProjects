<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class Trigger_planController extends Controller
{
    public function index($param = null): View
    {
        return view('trigger.index', compact('param'));
    }

    public function update(Request $request)
    {
        $param = $request->starttime;
        return redirect()->route('trigger.index', compact('param'));
    }
}
