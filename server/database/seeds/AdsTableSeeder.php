<?php

use App\Ads\Domain\Models\Ad;
use Illuminate\Database\Seeder;

class AdsTableSeeder extends Seeder
{
    /**
     * Run the Database Seeds
     * @return void
     */
    public function run()
    {
        factory(Ad::class, 100)->create();
    }
}
