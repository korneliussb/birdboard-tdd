@extends ('layouts.app')

@section('content')


<header class="flex items-center mb-3 py-4">
    <div class="flex justify-between items-end w-full">
        <h2 class="text-grey text-sm font-normal">My Project</h2>
        <a href="/projects/create" class="button">New Project</a>
        <!-- <a href="/projects/create" class="text-grey no-underline">New Project</a> -->

    </div>
</header>



<main class="lg:flex lg:flex-wrap -mx-3">
    @forelse($projects as $project)
    <div class="lg:w-1/3 px-3 pb-6">
        @include ('projects.card')
        <!-- folder projects/card  -->
    </div>
    @empty
    <div>No projects yet.</div>
    @endforelse
</main>

<!-- <ul>
    @forelse($projects as $project)
    <li>
        <a href="{{ $project->path() }}">{{ $project->title }}</a>
    </li>
    @empty
    <li>No Project yet.</li>
    @endforelse
</ul> -->

@endsection