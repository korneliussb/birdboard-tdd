<?php

namespace App\Http\Controllers;

use App\Project;

use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * View all projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $projects = Project::all();

        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        // $project = Project::findOrFail(request('project'));

        // if (auth()->id() != $project->owner_id) {
        //     abort(403);
        // }

        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }

        return view('projects.show', compact('project'));
    }

    public function store()
    {
        // dd('here we are');

        // validate
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        // $attributes['owner_id'] = auth()->id();

        auth()->user()->projects()->create($attributes);

        // dd($attributes);

        // persist
        // Project::create(request(['title', 'description']));
        // Project::create($attributes);

        // redirect
        return redirect('/projects');
    }
}
