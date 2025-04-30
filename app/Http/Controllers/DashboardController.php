<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

public function __construct()
{
    $this->middleware('auth');
}    public function index()
    {
        $projects = Auth::user()->projects()
                        ->with('university')
                        ->latest()
                        ->paginate(10);

        return view('dashboard', compact('projects'));
    }
}