<?php

use App\Ads\Domain\Models\Ad;
use Illuminate\Database\Seeder;
use App\Analytics\Domain\Models\StatsAge;

class StatsAgeAdTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ads = Ad::all();
        factory(StatsAge::class, 10)->create()->each(function ($age) use ($ads) {
            foreach ($ads as $ad) {
                $ad->statsAges()
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
