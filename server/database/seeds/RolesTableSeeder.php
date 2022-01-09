<?php

use App\Users\Domain\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'slug' => 'admin',
            'name' => 'administrator',
            'permissions' => [
                'create-user' => true,
                'update-user' => true,
                'change-user-role' => true,
                'create-campaign' => true,
                'update-campaign' => true,
                'delete-campaign' => true,
                'view-task' => true,
                'create-task' => true,
                'update-task' => true,
                'delete-task' => true,
                'update-settings' => true,
                'view-library' => true,
                'create-library' => true,
                'update-library' => true,
                'delete-library' => true,
                'index-all-transactions' => true,
                'done-transaction' => true,
                'cancel-transaction' => true,
                'create-tag' => true,
                'update-tag' => true,
                'delete-tag' => true,
                'view-tag' => true,
                'view-comment' => true,
                'update-comment' => true,
                'delete-comment' => true,
                'create-comment' => true,
                'approve-comment' => true,
                'view-reply' => true,
                'update-reply' => true,
                'delete-reply' => true,
                'create-reply' => true,
                'approve-reply' => true,
                'upgrade-user' => true,
                'downgrade-user' => true,
            ],
        ]);
        Role::create([
            'slug' => 'advertiser',
            'name' => 'advertiser',
            'permissions' => [
                'create-campaign' => true,
                'update-campaign' => true,
                'delete-campaign' => true,
                'create-ad' => true,
                'update-ad' => true,
                'delete-ad' => true,
                'index-private-transactions' => true,
                'delete-post' => true,
                'update-post' => true,
                'approve-post' => false,
                'create-task' => false,
                'update-tag' => true,
                'view-tag' => true,
                'delete-tag' => true,
                'create-comment' => true,
                'update-comment' => true,
                'delete-comment' => true,
                'view-comment' => true,
                'approve-comment' => true,
                'create-reply' => true,
                'update-reply' => true,
                'delete-reply' => true,
                'view-reply' => true,
                'approve-reply' => true,
                'upgrade-user' => false,
                'downgrade-user' => false,
            ],
        ]);
        Role::create([
            'name' => 'soldier',
            'slug' => 'soldier',
            'permissions' => [
                'view-library' => true,
                'index-private-transactions' => true,
                'cancel-transaction' => true,
                'view-post' => true,
                'update-post' => false,
                'delete-post' => false,
                'approve-post' => false,
                'create-task' => false,
                'view-tag' => false,
                'update-tag' => false,
                'delete-tag' => false,
                'create-comment' => true,
                'update-comment' => true,
                'view-comment' => true,
                'delete-comment' => true,
                'approve-comment' => false,
                'create-reply' => true,
                'update-reply' => true,
                'view-reply' => true,
                'delete-reply' => true,
                'approve-reply' => false,
                'upgrade-user' => false,
                'downgrade-user' => false,
            ],
        ]);
    }
}
