<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index()
    {
        $universities = University::withCount('projects')->orderBy('projects_count', 'desc')->get();
        return view('universities.index', compact('universities'));
    }

    public function show(University $university)
    {
        $projects = $university->projects()->with('user')->latest()->paginate(10);
        return view('universities.show', compact('university', 'projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:universities',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $university = University::create($request->only(['name', 'location', 'description']));

        return redirect()->back()->with('success', 'University added successfully!');
    }
}