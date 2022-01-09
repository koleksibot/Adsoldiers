<?php
namespace tests\Feature\Campaigns\Endpoints;

use App\Campaigns\Domain\Models\Campaign;
use App\Users\Domain\Models\Company;
use App\Users\Domain\Models\Role;
use App\Users\Domain\Models\User;
use Tests\TestCase;

class ShowCampaignTest extends TestCase
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

        $this->campaign = factory(Campaign::class)->create();
    }
    public function test_it_returns_a_200_status()
    {
        $this->jsonAs(
            $this->user,
            'GET',
            sprintf('api/campaigns/%s', $this->campaign->id)
        )->assertOk();
    }
    public function test_it_return_the_required_campaign()
    {
        $this->jsonAs(
            $this->user,
            'GET',
            sprintf('api/campaigns/%s', $this->campaign->id)
        )->assertJsonStructure(
            [
               'data' => [
                    'id',
                    'title',
                    'type',
                    'created_at_human',
                    'updated_at_human',
               ]
            ]
        );
    }
}
