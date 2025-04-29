<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Project;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function toggle(Project $project)
    {
        $like = $project->likes()->where('user_id', auth()->id())->first();

        if ($like) {
            $like->delete();
            return redirect()->back()->with('success', 'Project unliked!');
        } else {
            $project->likes()->create(['user_id' => auth()->id()]);
            return redirect()->back()->with('success', 'Project liked!');
        }
    }
}