<?php

namespace Tests\Feature\Users\Endpoints\Auth;

use App\Users\Domain\Models\Role;
use App\Users\Domain\Models\User;
use App\Users\Domain\Resources\UserResource;
use JWTAuth;
use Tests\TestCase;

class GetAuthenticatedUserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed('RolesTableSeeder');
    }
    /** @test */
    public function it_gets_user_by_token()
    {
        $user = factory(User::class)
            ->create(
                [
                    'password' => 'onetwothree',
                ]
            );
        $user->roles()->sync(Role::first());

        $userResource = new UserResource($user);
        $token = JWTAuth::fromUser($user);

        $this->get(
            '/api/auth/user',
            [
                'Authorization' => 'Bearer ' . $token,
            ]
        )->assertResource($userResource);
    }
}
