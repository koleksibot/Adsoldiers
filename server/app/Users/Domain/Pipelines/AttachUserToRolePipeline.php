<?php

namespace App\Users\Domain\Pipelines;

use Illuminate\Support\Str;
use App\App\Domain\Contracts\Pipeline;
use App\Users\Domain\Repositories\RoleRepository;

class AttachUserToRolePipeline implements Pipeline
{
    protected $roles;

    public function __construct(RoleRepository $roles)
    {
        $this->roles = $roles;
    }

    public function handle($data, \Closure $next)
    {
        $role = $data[0]['role'] ?? 'soldier';
        $user = $data[1];

        $user->roles()->attach(
            $this->roles->findRoleBySlug($role)
        );
        // if user role is not admin then add utm token to user
        $role !== 'admin' ? $user->update(['utm' => Str::random(32)]) : '' ;

        return $next($user);
    }
}
