<?php
namespace Tests\Feature\Endpoints\Users\Auth;

use App\Users\Domain\Models\User;
use Tests\TestCase;

class ChangeUserPasswordTest extends TestCase
{
    /** @test */
    public function it_shouldnt_let_user_change_password_if_current_password_passed_incorrectly()
    {
        $user = factory(User::class)->create([
            'password' => 'onetwothree',
        ]);

        $this->jsonAs($user, 'POST', '/api/auth/change-password', [
            'old_password' => 'another-password',
            'password' => 'another-secret',
            'password_confirmation' => 'another-secret',
        ])->assertStatus(406);
    }
    /** @test */
    public function it_should_let_user_change_password_if_current_password_passed_correctly()
    {
        $user = factory(User::class)->create([
            'password' => 'secret123!@#',
        ]);
        $this->jsonAs($user, 'POST', '/api/auth/change-password', [
            'old_password' => 'secret123!@#',
            'password' => 'another-secret',
            'password_confirmation' => 'another-secret',
        ])->assertStatus(200);
    }
}
