<?php
namespace tests\Feature\Campaigns\Endpoints;

use App\Campaigns\Domain\Models\Campaign;
use App\Users\Domain\Models\Company;
use App\Users\Domain\Models\Role;
use App\Users\Domain\Models\User;
use Tests\TestCase;

class DeleteCampaignTest extends TestCase
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

        $this->campaign = factory(Campaign::class)->create(
            [
                'owner_id' => $this->user->id
            ]
        );
    }
    public function test_it_returns_a_200_status_if_campaign_deleted()
    {
        $this->jsonAs(
            $this->user,
            'DELETE',
            sprintf('api/campaigns/%s', $this->campaign->id)
        )->assertOk();
    }
    public function test_it_return_delete_message()
    {
        $this->jsonAs(
            $this->user,
            'DELETE',
            sprintf('api/campaigns/%s', $this->campaign->id)
        )->assertJsonFragment(
            [
                "data" => [
                    "message" => "Campagin Deleted Successfully!"
                ]
            ]
        );
    }
}
