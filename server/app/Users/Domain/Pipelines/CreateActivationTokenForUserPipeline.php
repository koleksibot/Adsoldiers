<?php

namespace App\Users\Domain\Pipelines;

use App\App\Domain\Contracts\Pipeline;
use App\Jobs\TestJob;
use App\Users\Domain\Events\UserWasRegistered;
use App\Users\Domain\Mails\Activate;
use App\Users\Domain\Repositories\ActivationRepository;
use Illuminate\Support\Facades\Mail;

class CreateActivationTokenForUserPipeline implements Pipeline
{
    protected $activations;

    public function __construct(ActivationRepository $activations)
    {
        $this->activations = $activations;
    }

    public function handle($data, \Closure $next)
    {
        $user = $data[1];
        
        $activation = $this->activations->generateToken($user);
        
        // dispatchable event to sent activation message
        event(new UserWasRegistered($user, $activation));

        return $next($data);
    }
}
