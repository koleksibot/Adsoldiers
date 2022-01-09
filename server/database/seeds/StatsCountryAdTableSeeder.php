<?php

use App\Ads\Domain\Models\Ad;
use Illuminate\Database\Seeder;
use App\Analytics\Domain\Models\StatsCountry;

class StatsCountryAdTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ads = Ad::all();
        factory(StatsCountry::class, 10)->create()->each(function ($age) use ($ads) {
            foreach ($ads as $ad) {
                $ad->statsCountries()
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
