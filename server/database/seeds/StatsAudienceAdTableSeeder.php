<?php

use App\Ads\Domain\Models\Ad;
use Illuminate\Database\Seeder;
use App\Analytics\Domain\Models\StatsAudience;

class StatsAudienceAdTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ads = Ad::all();
        factory(StatsAudience::class, 10)->create()->each(function ($age) use ($ads) {
            foreach ($ads as $ad) {
                $ad->statsAudience()
                    ->attach(
                        $age->id,
                        [
                            'advertiser_id' => 2,
                            'visitors_number' => 155,
                        ]
                    );
            }
        });
    }
}
