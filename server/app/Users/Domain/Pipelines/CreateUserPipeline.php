<?php

namespace App\Users\Domain\Pipelines;

use Illuminate\Support\Arr;
use App\App\Domain\Contracts\Pipeline;
use App\Users\Domain\Repositories\UserRepository;
use App\App\Domain\Services\LocalFileUploadService;
use App\Users\Domain\Repositories\CompanyReposiroty;

class CreateUserPipeline implements Pipeline
{
    protected $users;
    protected $companies;

    public function __construct(UserRepository $users, CompanyReposiroty $companies)
    {
        $this->users = $users;
        $this->companies = $companies;
    }

    public function handle($data, \Closure $next)
    {
        if (isset($data['company'])) {
            // create company record
            $company = $this->companies->create(
                [
                    'name' => $data['company']
                ]
            );
            // remove company name from $data array
            Arr::forget($data, ['company']);
            // add company id to $data array
            $data['company_id'] = $company->id;
            // add admin role to data
            $data['role'] = 'Advertiser';
        }
        // upload profile picture
        // $storedPic = $this->handleFileUpload($data['picture']);
        // $data['picture'] = $storedPic->getFileName();
        // create user record
        $user = $this->users->create(Arr::except($data, ['role']));

        return $next([$data, $user]);
    }

    // public function handleFileUpload($file)
    // {
    //     return (new LocalFileUploadService($file))->save();
    // }
}
