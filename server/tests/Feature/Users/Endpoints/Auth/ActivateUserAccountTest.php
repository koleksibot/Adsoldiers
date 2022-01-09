<?php

namespace App\Feature\Users\Endpoints\Auth;

use App\Users\Domain\Models\User;
use Tests\TestCase;

class ActivateUserAccountTest extends TestCase
{
    /** @test */
    public function it_should_let_user_complete_his_activation()
    {
        $user = factory(User::class)->state('with-activation')->create();
        $this->get(vsprintf('api/auth/activate/%s/%s', [
            $user->email,
            $user->activation->token,
        ]))->assertStatus(200);
    }
    /** @test */
    public function it_shouldnt_let_user_complete_activation_if_passed_token_doesnt_exist()
    {
        $user = factory(User::class)->state('with-activation')->create();
        $this->get(vsprintf('api/auth/activate/%s/%s', [
            $user->id,
            'invalid-token',
        ]))->assertStatus(404);
    }
}
