<?php

namespace App\Users\Domain\Services;

use Illuminate\Support\Arr;
use App\App\Domain\Services\Service;
use App\App\Domain\Payloads\GenericPayload;
use App\Users\Domain\Repositories\UserRepository;
use App\App\Domain\Services\LocalFileUploadService;

class UpdateProfileService extends Service
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function handle($data = [])
    {
        if (isset($data['picture'])) {
            $storedPic = $this->handleFileUpload($data['picture']);
            $data['picture'] = $storedPic->getFileName();
        }

        auth()->user()->update(
            Arr::except($data, 'current_password')
        );

        return new GenericPayload(
            [
                'message' => 'Profile Sucessfully Updated'
            ]
        );
    }

    public function handleFileUpload($file)
    {
        return (new LocalFileUploadService($file))->save();
    }
}
