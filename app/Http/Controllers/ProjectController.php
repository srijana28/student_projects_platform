<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('can:create,App\Models\Project')->only(['create', 'store']);
        $this->middleware('can:update,project')->only(['edit', 'update']);
        $this->middleware('can:delete,project')->only(['destroy']);
    }


    public function index()
    {
        $projects = Project::with(['university', 'user'])->latest()->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $universities = University::all();
        return view('projects.create', compact('universities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'github_link' => 'nullable|url',
            'documentation_link' => 'nullable|url',
            'university_id' => 'required|exists:universities,id',
            'tags' => 'nullable|string',
        ]);

        $project = auth()->user()->projects()->create($request->all());

        return redirect()->route('projects.show', $project)->with('success', 'Project created successfully!');
    }

    public function show(Project $project)
    {
        $project->load(['university', 'user', 'comments.user', 'likes']);
        return view('dashboard', compact('project'));
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project);
        $universities = University::all();
        return view('projects.edit', compact('project', 'universities'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project); 
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'github_link' => 'nullable|url',
            'documentation_link' => 'nullable|url',
            'university_id' => 'required|exists:universities,id',
            'tags' => 'nullable|string',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.show', $project)->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully!');
    }
}