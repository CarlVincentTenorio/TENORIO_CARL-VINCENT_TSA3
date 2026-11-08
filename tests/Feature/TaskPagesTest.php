<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class TaskPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->travelTo(Carbon::create(2026, 11, 9, 23, 30, 0, 'Asia/Manila'));
    }

    protected function tearDown(): void
    {
        $this->travelBack();
        parent::tearDown();
    }

    public function test_seeder_provides_eight_tasks_three_dates_and_one_user(): void
    {
        $this->seed();

        $this->assertDatabaseCount('tasks', 8);
        $this->assertDatabaseCount('users', 1);
        $this->assertGreaterThanOrEqual(3, Task::query()->select('task_date')->distinct()->get()->count());
        $this->assertTrue(Task::query()->whereDate('task_date', today())->exists());
    }

    public function test_welcome_shows_only_tasks_for_the_current_manila_date(): void
    {
        Task::create(['title' => 'PAST-only task', 'task_date' => today()->subDay()]);
        Task::create(['title' => 'TODAY-only task', 'task_date' => today()]);
        Task::create(['title' => 'FUTURE-only task', 'task_date' => today()->addDay()]);

        $this->get('/')
            ->assertOk()
            ->assertSee('TODAY-only task')
            ->assertDontSee('PAST-only task')
            ->assertDontSee('FUTURE-only task');
    }

    public function test_task_list_contains_every_task_in_date_order(): void
    {
        Task::create(['title' => 'FUTURE ordered record', 'task_date' => today()->addDay()]);
        Task::create(['title' => 'PAST ordered record', 'task_date' => today()->subDay()]);
        Task::create(['title' => 'TODAY ordered record', 'task_date' => today()]);

        $this->get('/tasks')
            ->assertOk()
            ->assertSeeInOrder(['PAST ordered record', 'TODAY ordered record', 'FUTURE ordered record']);
    }

    public function test_profile_displays_the_seeded_user(): void
    {
        $this->seed();

        $this->get('/profile')
            ->assertOk()
            ->assertSee('Carl Vincent Tenorio')
            ->assertSee('carlvincent')
            ->assertSee('carlvincent@example.com');
    }

    public function test_about_identifies_the_developer_without_requiring_data(): void
    {
        $this->get('/about')->assertOk()->assertSee('Carl Vincent Tenorio');
    }

    public function test_pages_have_useful_empty_states(): void
    {
        $this->get('/')->assertOk()->assertSee('No tasks are scheduled for today.');
        $this->get('/tasks')->assertOk()->assertSee('No tasks are available yet.');
        $this->get('/profile')->assertOk()->assertSee('No profile is available.');
    }

    public function test_database_supplies_pending_as_the_default_task_status(): void
    {
        $task = Task::create(['title' => 'Task without an explicit status', 'task_date' => today()]);

        $this->assertSame('pending', $task->refresh()->status);
    }

    public function test_usernames_must_be_unique(): void
    {
        User::create(['username' => 'same-user', 'full_name' => 'First User', 'email' => 'first@example.com']);

        $this->expectException(QueryException::class);

        User::create(['username' => 'same-user', 'full_name' => 'Second User', 'email' => 'second@example.com']);
    }

    public function test_seeding_again_on_a_new_day_refreshes_dates_without_duplicates(): void
    {
        $this->seed();
        $this->travel(2)->days();
        $this->seed();

        $this->assertDatabaseCount('tasks', 8);
        $this->assertDatabaseCount('users', 1);
        $this->assertSame(3, Task::query()->whereDate('task_date', today())->count());
    }

    public function test_task_titles_are_escaped_in_the_browser(): void
    {
        Task::create(['title' => '<script>alert("task")</script>', 'task_date' => today()]);

        $this->get('/')
            ->assertOk()
            ->assertSee('&lt;script&gt;', false)
            ->assertDontSee('<script>alert(', false);
    }
}
