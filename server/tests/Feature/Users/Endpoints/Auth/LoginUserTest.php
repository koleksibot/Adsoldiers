<?php

namespace Tests\Feature\Endpoints\Users\Auth;

use App\Users\Domain\Models\Role;
use App\Users\Domain\Models\User;
use Tests\TestCase;

class LoginUserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed('RolesTableSeeder');
    }
    /** @test */
    public function it_should_throw_an_error_message_if_user_is_not_activated_yet()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('onetwothree'),
            'email' => 'mohammedosama@ieee.org',
        ]);
        $response = $this->post(
            '/api/auth/login',
            [
                'email' => $user->email,
                'password' => 'onetwothree',
            ]
        )->assertJsonStructure(['data' => ['message']]);
    }
    /** @test */
    public function it_logs_user_out_once_activaion_isnt_completed_while_logging_in()
    {
        $user = factory(User::class)->states('with-activation')->create([
            'username' => 'mohammed',
            'password' => bcrypt('onetwothree'),
            'email' => 'mohammedosama@ieee.org',
        ]);
        $this->post(
            '/api/auth/login',
            [
                'email' => $user->email,
                'password' => 'onetwothree',
            ]
        );
        $this->assertNull(auth()->user());
    }
    /** @test */
    public function it_shouldnt_let_user_login_if_validation_didnt_pass()
    {
        $this->post(
            '/api/auth/login',
            [
                'email' => 'someone',
                'password' => 'secret',
            ]
        )->assertStatus(422);
    }
    /** @test */
    public function it_shouldnt_let_user_login_if_passed_credentials_are_invalid()
    {
        $user = factory(User::class)->states('with-activation')->create([
            'username' => 'mohammed',
            'email' => 'mohammedosama@ieee.org',
            'password' => 'onetwothree',
        ]);
        $user->activation()->update([
            'completed_at' => now(),
        ]);
        $response = $this->post(
            '/api/auth/login',
            [
                'email' => 'someone@gmail.com',
                'password' => 'onetwothree',
            ]
        )->assertStatus(422);
    }
    /** @test */
    public function it_should_login_user_if_data_is_correct_and_activated()
    {
        $user = factory(User::class)->states('with-activation')->create([
            'username' => 'mohammed',
            'email' => 'mohammedosama@ieee.org',
            'password' => 'onetwothree',
        ]);
        
        $user->roles()->sync([Role::first()->id]);

        $user->activation()->update([
            'completed_at' => now(),
        ]);

        $response = $this->post(
            '/api/auth/login',
            [
                'email' => $user->email,
                'password' => 'onetwothree',
            ]
        )->assertJsonStructure(['meta' => ['token']]);
    }
}
