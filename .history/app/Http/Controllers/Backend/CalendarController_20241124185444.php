<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $sections = Section::with('lectures')
                          ->orderBy('date')
                          ->get();
        
        return view('calendar.index', compact('sections'));
    }
}
