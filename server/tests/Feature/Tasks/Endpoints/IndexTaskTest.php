<?php
namespace tests\Feature\Tasks\Endpoints;

use App\Tasks\Domain\Models\Task;
use App\Users\Domain\Models\Company;
use App\Users\Domain\Models\Role;
use App\Users\Domain\Models\User;
use Tests\TestCase;

class IndexTaskTest extends TestCase
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

        $this->tasks = factory(Task::class, 3)->create([
            'media' => ["img/9NLX91evBUR3jyOKeDtT5DR6DKFRrCsVaPHOtA9O.jpeg"],
            'media_type' => 'image',
        ]);
    }
    public function test_it_returns_a_200_status()
    {
        $this->jsonAs($this->user, 'GET', 'api/tasks')
            ->assertOk();
    }
    public function test_it_returns_tasks_in_its_body()
    {
        $this->jsonAs($this->user, 'GET', 'api/tasks')
            ->assertJsonStructure(
                [
                    'status',
                    'data'
                ]
            );
    }
}
