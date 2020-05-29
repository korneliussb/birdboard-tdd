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

    /**
     * Show a single project.
     *
     * @param \App\Project $project
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // $project = Project::findOrFail(request('project'));

        // if (auth()->id() != $project->owner_id) {
        //     abort(403);
        // }

        // if (auth()->user()->isNot($project->owner)) {
        //     abort(403);
        // }

        $this->authorize('update', $project);

        return view('projects.show', compact('project'));
    }

    /**
     * Create a new project.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Persist a new project.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        // dd('here we are');

        // validate
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'notes' => 'min:3'
        ]);

        // dd($attributes);

        // $attributes['owner_id'] = auth()->id();

        $project = auth()->user()->projects()->create($attributes);

        // dd($attributes);

        // persist
        // Project::create(request(['title', 'description']));
        // Project::create($attributes);

        // redirect
        return redirect($project->path());
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Project $project)
    {
        $this->authorize('update', $project);

        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'notes' => 'min:3'
        ]);

        $project->update($attributes);

        return redirect($project->path());
    }
}
