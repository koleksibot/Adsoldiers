<?php
namespace tests\Feature\Campaigns\Endpoints;

use App\Tasks\Domain\Models\Task;
use App\Users\Domain\Models\Company;
use App\Users\Domain\Models\Role;
use App\Users\Domain\Models\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class DeleteTaskTest extends TestCase
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

        $this->task = factory(Task::class)->create(
            [
                'media' => ["img/9NLX91evBUR3jyOKeDtT5DR6DKFRrCsVaPHOtA9O.jpeg"],
                'media_type' => 'image',
            ]
        );
    }
    public function test_it_returns_a_200_status_if_task_deleted()
    {
        $this->jsonAs(
            $this->user,
            'DELETE',
            sprintf('api/tasks/%s', $this->task->id)
        )->assertOk();
    }
    public function test_it_return_delete_message()
    {
        $this->jsonAs(
            $this->user,
            'DELETE',
            sprintf('api/tasks/%s', $this->task->id)
        )->assertJsonFragment(
            [
                "data" => [
                    'message' => 'Task Deleted Successfully',
                ]
            ]
        );
    }
}
