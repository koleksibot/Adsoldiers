<?php

namespace Tests\Feature\Users\Endpoints\Auth;

use App\Users\Domain\Models\Reminder;
use App\Users\Domain\Models\User;
use Tests\TestCase;

class ResetUserPasswordTest extends TestCase
{
    /** @test */
    public function it_shouldnt_let_user_reset_their_password_if_reminder_couldnt_be_completed()
    {
        $user = factory(User::class)->create();
        $reminder = factory(Reminder::class)->make()->toArray();
        $user->reminder()->create($reminder);
        $this->post(vsprintf('/api/auth/reset-password/%s/%s', [
            $user->id,
            'invalidToken',
        ]), [
            'password' => 'hellothere',
            'password_confirmation' => 'hellothere',
        ])->assertStatus(404);
    }
    /** @test */
    public function it_should_let_user_reset_their_password_if_reminder_can_be_completed()
    {
        $user = factory(User::class)->create();
        $reminder = factory(Reminder::class)->make()->toArray();
        $user->reminder()->create($reminder);
        $this->post(
            vsprintf(
                '/api/auth/reset-password/%s/%s',
                [
                    $user->email,
                    $reminder['token'],
                ]
            ),
            [
                'password' => 'hellothere',
                'password_confirmation' => 'hellothere',
            ]
        )->assertStatus(201);
        $this->assertDatabaseHas(
            'reminders',
            [
                'user_id' => $user->id,
                'token' => null,
            ]
        );
    }
}
