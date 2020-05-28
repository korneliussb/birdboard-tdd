@extends ('layouts.app')

@section('content')

<header class="flex items-center mb-3 py-4">
    <div class="flex justify-between items-end w-full">
        <p class="text-grey text-sm font-normal">
            <a href="/projects" class="text-grey text-sm font-normal no-underline hover:underline">My Projects</a> / {{$project->title}}
        </p>

        <a href="/projects/create" class="button">New Project</a>
    </div>
</header>

<main>
    <div class="lg:flex -mx-3">
        <div class="lg:w-3/4 px-3 mb-6">
            <div class="mb-8">
                <h2 class="text-lg text-grey font-normal mb-3">Tasks</h2>

                <!-- Tasks -->
                @foreach ($project->tasks as $task)
                <div class="card mb-3">
                    <form method="POST" action="{{ $task->path() }}">
                        @method('PATCH')
                        @csrf

                        <div class="flex">
                            <input name="body" value="{{ $task->body }}" class="w-full {{ $task->completed ? 'text-grey' : '' }}">
                            <input name="completed" type="checkbox" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                        </div>

                    </form>
                </div>
                @endforeach

                <div class="card mb-3">
                    <form action="{{ $project->path() . '/tasks'}}" method="POST">
                        @csrf
                        <input type="text" placeholder="Add a new task..." class="w-full" name="body">
                    </form>
                </div>
            </div>

            <div>
                <h2 class="text-lg text-grey font-normal">General Notes</h2>
                <!-- General Notes -->
                <textarea class="card w-full" style="min-height: 200px">Lorem ipsum.</textarea>
            </div>
        </div>

        <div class="lg:w-1/4 px-3">
            @include('projects.card')
            <!-- <div class="card">
                <h1>{{$project->title}}</h1>
                <div>{{$project->description}}</div>
                <a href="/projects">Go Back</a>
            </div> -->
        </div>
    </div>
</main>



@endsection