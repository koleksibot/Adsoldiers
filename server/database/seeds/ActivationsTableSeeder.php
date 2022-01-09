<?php

use App\Users\Domain\Models\Activation;
use Illuminate\Database\Seeder;

class ActivationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Activation::create([
            'user_id' => '1',
            'token' => null,
            'completed_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Activation::create([
            'user_id' => '2',
            'token' => null,
            'completed_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Activation::create([
            'user_id' => '3',
            'token' => null,
            'completed_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
