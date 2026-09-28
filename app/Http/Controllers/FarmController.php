<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Farm;

class FarmController extends Controller
{
    public function index()
    {
        $farms = Farm::where('status', 1)->latest()->get();
        return view('farms.index', compact('farms'));
    }

    public function show($slug)
    {
        $farm = Farm::where('slug', $slug)->where('status', 1)->firstOrFail();
        return view('farms.show', compact('farm'));
    }
}
