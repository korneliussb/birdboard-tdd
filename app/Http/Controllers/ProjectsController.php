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
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {


        // $project = Project::findOrFail(request('project'));

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
