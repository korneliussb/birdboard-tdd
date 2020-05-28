<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_project_can_have_tasks()
    {
        // $this->actingAs(factory('App\User')->create());

        // $this->withoutExceptionHandling();
        $this->signIn();

        $project = auth()->user()->projects()->create(
            factory(Project::class)->raw()
        );

        // $project = factory(Project::class)->create(['owner_id' => auth()->id()]);

        $this->post($project->path() . '/tasks', ['body' => 'Test Task']);

        $this->get($project->path())
            ->assertSee('Test Task');
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $this->signIn();


        $project = auth()->user()->projects()->create(
            factory(Project::class)->raw()
        );

        $attributes = factory('App\Task')->raw(['body' => '']); // store as an array, not an object => raw()

        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
