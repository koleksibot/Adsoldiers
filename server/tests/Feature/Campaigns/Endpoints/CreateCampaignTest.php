<?php

namespace tests\Feature\Campaigns\Endpoints;

use App\Campaigns\Domain\Models\Campaign;
use App\Users\Domain\Models\Company;
use App\Users\Domain\Models\Role;
use App\Users\Domain\Models\User;
use Tests\TestCase;

class CreateCampaignTest extends TestCase
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

        $this->campaign = Campaign::make([
            'title' => 'campaign1',
            'type' => 'awareness',
        ])->toArray();
    }
    public function test_it_returns_a_201_status_if_campaign_created()
    {
        $this->jsonAs($this->user, 'POST', 'api/campaigns/create', $this->campaign)
            ->assertCreated();
    }
    public function test_it_return_the_just_created_campaign()
    {
        $this->jsonAs($this->user, 'POST', 'api/campaigns/create', $this->campaign)
            ->assertJsonFragment(
                [
                    'data' => [
                        'message' => 'Campaign Created Successfully'
                    ]
                ]
            );
    }
}
