<?php

namespace Tests\Feature\Users\Endpoints\Auth;

use App\Users\Domain\Listeners\SendActivationMail;
use App\Users\Domain\Listeners\SendMailActivation;
use App\Users\Domain\Models\User;
use Queue;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed('RolesTableSeeder');
    }
    /** @test */
    public function it_shouldnt_let_user_register_if_email_or_username_exists()
    {
        $user = factory(User::class)->create([
            'username' => 'mohammed',
            'username' => 'mohammed',
        ]);
        $this->post(
            '/api/auth/register',
            array_merge($user->toArray(), [
                'password' => 'secret123!@#',
                'password_confirmation' => 'secret123!@#',
            ])
        )->assertStatus(422)->assertJsonStructure([
            'errors' => ['email', 'username'],
        ]);
    }
    /** @test */
    public function it_registers_user_with_correct_data()
    {
        Queue::fake();
        $user = factory(User::class)->make([
            'username' => 'mohammed',
            'email' => 'hello@gmail.com',
        ]);
        $response = $this->post(
            '/api/auth/register',
            array_merge($user->toArray(), [
                'password' => 'secret123!@#',
                'password_confirmation' => 'secret123!@#',
            ])
        )->assertStatus(201);

        Queue::assertPushed(\Illuminate\Events\CallQueuedListener::class, function ($job) use ($user) {
            return $job->class === SendActivationMail::class;
        });
    }
}
