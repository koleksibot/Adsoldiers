<?php

namespace App\Ads\Domain\Services;

use App\Ads\Domain\Repositories\AdRepository;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\LocalFileUploadService;
use App\App\Domain\Services\Service;

class UpdateAdService extends Service
{
    protected $ads;

    public function __construct(AdRepository $ads)
    {
        $this->ads = $ads;
    }

    public function handle($data = [], $ad = null)
    {
        $dropDowns = [
            'age',
            'targeted_audience',
            'country',
            'city',
            'language'
        ];

        foreach ($data as $key => $value) {
            if (
                in_array($key, $dropDowns) &&
                !is_array($data[$key])
            ) {
                $data[$key] = strpos($data[$key], ',') ?  explode(',', $data[$key]) :  [$data[$key]];
            }
        }
        // if task has media
        if (isset($data['media'])) {
            // store media with new unique name and get the name
            $storedFile = $this->handleFileUpload($data['media']);
            $data['media'] = $storedFile->getFileName();
        }

        $ad->update($data);
        return new GenericPayload(['message' => 'Ad Updated Successfully']);
    }

    public function handleFileUpload($file)
    {
        return (new LocalFileUploadService($file))->saveMany();
    }
}
