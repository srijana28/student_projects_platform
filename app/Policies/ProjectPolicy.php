<?php

namespace App\Policies;


use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;

class ProjectPolicy
{
    use HandlesAuthorization;
    
    public function create(User $user)
{
    return true; // Allow all authenticated users to create
}

    public function update(User $user, Project $project)
    {
        
        return $user->id === $project->user_id;
    }

    public function delete(User $user, Project $project)
    {
        return $user->id === $project->user_id;
    }
}