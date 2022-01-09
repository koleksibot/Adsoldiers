<?php

use App\Campaigns\Domain\Models\Campaign;
use Illuminate\Database\Seeder;

class CampaignsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Campaign::class, 60)->create();
    }
}
