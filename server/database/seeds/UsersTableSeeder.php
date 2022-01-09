<?php

use App\Users\Domain\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@adsoldiers.com',
            'password' => '12345678',
            'address' => 'Dummy Address',
            'mobile' => '01156321668',
            'picture' => 'img/profile_pic_Placeholder.png',
            'tasks_lvl' => 1,
        ]);
        // give the user role admin
        $admin->roles()->sync([1]);

        $advertiser = User::create([
            'username' => 'advertiser',
            'company_id' => 1,
            'email' => 'advertiser@adsoldiers.com',
            'password' => '12345678',
            'address' => 'Dummy Address',
            'mobile' => '01156321668',
            'picture' => 'img/profile_pic_Placeholder.png',
            // 'company' => 'advertiserCompany',
            'utm' => Str::random(32),
            'tasks_lvl' => 1,
        ]);
        // give the user role admin
        $advertiser->roles()->sync([2]);

        $soldier = User::create([
            'username' => 'soldier',
            'company_id' => 1,
            'email' => 'soldier@adsoldiers.com',
            'password' => '12345678',
            'address' => 'Dummy Address',
            'mobile' => '01156321668',
            'picture' => 'img/profile_pic_Placeholder.png',
            // 'company' => 'soldierCompany',
            'utm' => 'vrKnVy8QxkcLTPGqlWIpyx8Em6TyTQ1P',
            'tasks_lvl' => 1,
        ]);
        // give the user role admin
        $soldier->roles()->sync([3]);
    }
}
