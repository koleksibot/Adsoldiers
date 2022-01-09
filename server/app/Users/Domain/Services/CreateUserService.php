<?php

namespace App\Users\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Payloads\UnauthorizedPayload;
use App\App\Domain\Payloads\ValidationPayload;
use App\App\Domain\Services\Service;
use App\Users\Domain\Repositories\CompanyReposiroty;
use App\Users\Domain\Repositories\RoleRepository;
use App\Users\Domain\Repositories\UserRepository;
use Illuminate\Support\Arr;

class CreateUserService extends Service
{
    protected $users;
    protected $roles;
    protected $companies;

    public function __construct(UserRepository $users, RoleRepository $roles, CompanyReposiroty $companies)
    {
        $this->users = $users;
        $this->roles = $roles;
        $this->companies = $companies;
    }
    public function handle($data = [])
    {
        if (auth()->user()->can('create-user')) {
            try {
                // encrypt password
                $data['password'] = bcrypt($data['password']);
                // if user role is advertiser then create company
                if ($data['slug'] == 'Advertiser') {
                    $company = $this->companies->create([
                        'name' => $data['company'],
                    ]);
                    // Add the just created ID in the data array
                    $data['company_id'] = $company->id;
                }
                // remove company name form data array in both cases
                isset($data['company']) ? Arr::forget($data, 'company') : '';
                //user creation
                $user = $this->users->create(Arr::except($data, ['slug']));
                // find the role by slug then attach it in pivot table to this user
                $this->roles->findRoleBySlug($data['slug'])->users()->attach($user);
                // retur success message
                return new GenericPayload([
                    'message' => 'User Created Successfully',
                ], 201);
            } catch (Exception $e) {
                return new ValidationPayload($e);
            }
        }
        return new UnauthorizedPayload;
    }
}
