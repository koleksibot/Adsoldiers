<?php
namespace tests\Feature\Campaigns\Endpoints;

use App\Campaigns\Domain\Models\Campaign;
use App\Users\Domain\Models\Company;
use App\Users\Domain\Models\Role;
use App\Users\Domain\Models\User;
use Tests\TestCase;

class IndexCampaignTest extends TestCase
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
        $campaigns = factory(Campaign::class, 30)->create();
    }
    public function test_it_returns_a_200_status()
    {
        $this->jsonAs($this->user, 'GET', 'api/campaigns')
            ->assertOk();
    }
    public function test_it_returns_campaigns_in_its_body()
    {
        $this->jsonAs($this->user, 'GET', 'api/campaigns')
            ->assertJsonStructure(
                [
                    'status',
                    'data' => [
                        'data',
                        'links'
                    ]
                ]
            );
    }
}
