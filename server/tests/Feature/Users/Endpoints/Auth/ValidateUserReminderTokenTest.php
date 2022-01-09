<?php

namespace Tests\Feature\Endpoints\Users\Auth;

use App\Users\Domain\Models\User;
use App\Users\Domain\Repositories\ReminderRepository;
use Tests\TestCase;

class ValidateUserReminderTokenTest extends TestCase
{
    /** @test */
    public function it_shouldnt_let_user_validate_his_reminder_token_if_user_isnt_activated_yet()
    {
        $user = factory(User::class)->states('with-activation')->create();
        $this->get(
            vsprintf(
                '/api/auth/reset-password/%s/%s',
                [
                    $user->email,
                    $user->activation->token,
                ]
            )
        )->assertJsonFragment(
            [
                'message' => 'You have not activated your account',
            ]
        );
    }
    /** @test */
    public function it_shouldnt_return_a_response_message_with_invalid_token_if_passed_token_doesnt_belong_to_the_user()
    {
        $user = factory(User::class)->states('with-activation')->create();
        $anotherUser = factory(User::class)->states('with-activation')->create();
        app(ReminderRepository::class)->generateToken($user);
        app(ReminderRepository::class)->generateToken($anotherUser);
        $user->activation->update([
            'completed_at' => now(),
        ]);
        $this->get(vsprintf('/api/auth/reset-password/%s/%s', [
            $user->id,
            $anotherUser->reminder->token,
        ]))->assertJson([
            'message' => 'Could not find such a record',
        ])->assertStatus(404);
    }
    /** @test */
    public function it_should_return_a_success_message_response_if_passed_token_is_valid()
    {
        $user = factory(User::class)->states('with-activation')->create();
        app(ReminderRepository::class)->generateToken($user);
        $user->activation->update([
            'completed_at' => now(),
        ]);
        $this->get(
            vsprintf(
                '/api/auth/reset-password/%s/%s',
                [
                    $user->email,
                    $user->reminder->token,
                ]
            )
        )->assertJsonFragment(
            [
                'message' => 'Alright ' . $user->first_name . ' Let\'s setup a new password',
            ]
        );
    }
}
