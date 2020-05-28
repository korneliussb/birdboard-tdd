<div class="card" style="height: 200px">

    <h3 class="font-normal text-lg py-4 mb-3 -ml-5 border-l-4 border-blue-light pl-4">
        <a href="{{ $project->path() }}" class="text-black no-underline">
            {{$project->title}}

        </a>
    </h3>

    <div class="text-grey">{{ str_limit($project->description, 150) }}</div>
    <!-- <div>{{ Illuminate\Support\Str::limit($project->description, 200) }}</div> -->
</div>