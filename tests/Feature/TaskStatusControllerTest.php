<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Gate;

class TaskStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_response_code_and_pagination_15_per_page(): void
    {
        TaskStatus::factory()->count(20)->create();

        $response = $this->get(route('task_statuses.index'));

        $response->assertStatus(200);
        $response->assertViewHas('taskStatuses');

        $taskStatuses = $response->viewData('taskStatuses');

        $this->assertEquals(15, $taskStatuses->count());
        $this->assertTrue($taskStatuses->hasMorePages());
    }

    public function test_create_status_response_code(): void
    {
        $response = $this->actingAsGuest()->get(route('task_statuses.create'));
        $response->assertStatus(403);

        $user = User::factory()->create();

        Gate::shouldReceive('authorize')->with('create', TaskStatus::class)->andReturn(true);

        $response = $this->actingAs(($user))->get(route('task_statuses.create'));

        $response->assertStatus(200);
        $response->assertViewIs('task_statuses.create');
        $response->assertViewHas('status');
    }

    public function test_store_status_success(): void
    {
        $user = User::factory()->create();

        Gate::shouldReceive('authorize')->with('create', TaskStatus::class)->andReturn(true);

        $response = $this->actingAs(($user))->post(route('task_statuses.store'), [
            'name' => 'New Task Status',
        ]);
        $response->assertValid();
        $response->assertRedirect(route('task_statuses.index'));

        $this->assertDatabaseHas('task_statuses', [
            'name' => 'New Task Status',
        ]);
    }

    public function test_store_status_empty_name_validation(): void
    {
        $user = User::factory()->create();

        Gate::shouldReceive('authorize')->with('create', TaskStatus::class)->andReturn(true);

        $response = $this->actingAs(($user))->post(route('task_statuses.store'), [
            'name' => ''
        ]);
        $response->assertInvalid(['name']);
        $response->assertSessionHasErrors();
    }

    public function test_store_status_duplicate_name_validation(): void
    {
        $existingTaskStatus = TaskStatus::factory()->create([
            'name' => 'Duplicate Name'
        ]);
        $user = User::factory()->create();

        Gate::shouldReceive('authorize')->with('create', TaskStatus::class)->andReturn(true);

        $response = $this->actingAs(($user))->post(route('task_statuses.store'), [
            'name' => 'Duplicate Name'
        ]);
        $response->assertInvalid(['name']);
        $response->assertSessionHasErrors();
    }

    public function test_edit_status_success(): void
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();

        Gate::shouldReceive('authorize')->with('update', TaskStatus::class)->andReturn(true);

        $response = $this->actingAs($user)->get(route('task_statuses.edit', [
            'task_status' => $taskStatus->id,
        ]));
        $response->assertStatus(200);
        $response->assertViewIs('task_statuses.edit');
        $response->assertViewHas('status', $taskStatus);
    }

    public function test_edit_status_as_guest(): void
    {
        $taskStatus = TaskStatus::factory()->create();
        $response = $this->actingAsGuest()->get(route('task_statuses.edit', [
            'task_status' => $taskStatus->id,
        ]));

        $response->assertStatus(403);
    }

    public function test_edit_status_non_existed(): void
    {
        $user = User::factory()->create();
        Gate::shouldReceive('authorize')->with('update', TaskStatus::class)->andReturn(false);

        $response = $this->actingAs($user)->get(route('task_statuses.edit', [
            'task_status' => 000,
        ]));

        $response->assertStatus(404);
    }

    public function test_update_status_success(): void
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();
        Gate::shouldReceive('authorize')->with('update', $taskStatus)->andReturn(true);

        $response = $this->actingAs($user)->patch(route('task_statuses.update', [
            'task_status' => $taskStatus->id,
        ]), [
            'name' => 'New Task Status'
        ]);

        $response->assertValid();
        $response->assertRedirect(route('task_statuses.index'));

        $this->assertDatabaseHas('task_statuses', [
            'id' => $taskStatus->id,
            'name' => 'New Task Status'
        ]);
    }

    public function test_update_status_empty_name_validation(): void
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();
        Gate::shouldReceive('authorize')->with('update', TaskStatus::class)->andReturn(true);

        $response = $this->actingAs($user)->patch(route('task_statuses.update', [
            'task_status' => $taskStatus->id,
        ]), [
            'name' => ''
        ]);

        $response->assertInvalid(['name']);
        $response->assertSessionHasErrors();

        $this->assertDatabaseHas('task_statuses', [
            'id' => $taskStatus->id,
            'name' => $taskStatus->name
        ]);
    }

    public function test_update_status_duplicate_name_validation(): void
    {
        $user = User::factory()->create();
        $existingStatus = TaskStatus::factory()->create([
            'name' => 'Duplicate Name'
        ]);
        $statusToUpdate = TaskStatus::factory()->create();
        Gate::shouldReceive('authorize')->with('update', TaskStatus::class)->andReturn(true);

        $response = $this->actingAs($user)->patch(route('task_statuses.update',[
            'task_status' => $statusToUpdate->id,
        ]), [
            'name' => 'Duplicate Name'
        ]);

        $response->assertInvalid(['name']);
        $response->assertSessionHasErrors();
    }

    public function test_delete_status_success(): void
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();

        Gate::shouldReceive('authorize')->with('delete', TaskStatus::class)->andReturn(true);

        $response = $this->actingAs($user)->delete(route('task_statuses.destroy', [
            'task_status' => $taskStatus->id,
        ]));

        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseMissing('task_statuses', [
            'id' => $taskStatus->id,
        ]);
    }

    public function test_delete_status_as_guest(): void
    {
        $taskStatus = TaskStatus::factory()->create();

        $response = $this->actingAsGuest()->delete(route('task_statuses.destroy', [
            'task_status' => $taskStatus->id,
        ]));

        $response->assertStatus(403);
    }

    public function test_delete_status_non_existed(): void
    {
        $user = User::factory()->create();
        Gate::shouldReceive('authorize')->with('delete', TaskStatus::class)->andReturn(false);

        $response = $this->actingAs($user)->delete(route('task_statuses.destroy', [
            'task_status' => 0000,
        ]));

        $response->assertStatus(404);
    }
}
