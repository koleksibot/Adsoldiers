<?php
namespace tests\Feature\Tasks\Endpoints;

use App\Tasks\Domain\Models\Task;
use App\Users\Domain\Models\Company;
use App\Users\Domain\Models\Role;
use App\Users\Domain\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed('RolesTableSeeder');
        
        $this->user = factory(User::class)->create(
            [
                'company_id' => $this->company = factory(Company::class)->create()
            ]
        );
        $this->user->roles()->sync(Role::first());

        $this->task = factory(Task::class)->make(
            [
                'title' => 'first task'
            ]
        )->toArray();

        $this->task = array_merge(
            $this->task,
            [
                'media' => [UploadedFile::fake()->image('9NLX91evBUR3jyOKeDtT5DR6DKFRrCsVaPHOtA9O.jpeg', 200, 200)]
            ]
        );
    }
    public function test_it_returns_a_201_status_if_task_created()
    {
        $this->jsonAs($this->user, 'POST', 'api/tasks/create', $this->task)
            ->assertCreated();
    }
    public function test_it_return_the_just_created_task()
    {
        $this->jsonAs($this->user, 'POST', 'api/tasks/create', $this->task)
           ->assertJsonFragment(
               [
                    'data' => [
                        'message' => 'task created successfully',
                    ]
                ]
           );
    }
}
