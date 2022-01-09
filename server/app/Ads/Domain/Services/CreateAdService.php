<?php

namespace App\Ads\Domain\Services;

use App\App\Domain\Services\Service;
use App\Ads\Domain\Notifications\AdCreated;
use App\App\Domain\Payloads\GenericPayload;
use Illuminate\Support\Facades\Notification;
use App\Ads\Domain\Repositories\AdRepository;
use App\Users\Domain\Repositories\UserRepository;
use App\App\Domain\Services\LocalFileUploadService;
use App\Notifications\Domain\Utilities\FirebaseNotification;

class CreateAdService extends Service
{
    protected $ads;
    protected $users;
    protected $inputFields;

    public function __construct(AdRepository $ads, UserRepository $users)
    {
        $this->ads = $ads;
        $this->users = $users;
        $this->dropDowns = [
            'language',
            'age',
            'targeted_audience',
            'country',
            'city',
        ];
    }

    public function handle($data = [])
    {
        foreach ($data as $key => $value) {
            if (!is_array($data[$key]) && in_array($key, $this->dropDowns)) {
                $data[$key] = strpos($data[$key], ',') ? explode(',', $data[$key]) : (array) $data[$key];
            }
        }

        // if ad has media
        if (isset($data['media'])) {
            // store media with new unique name and get the name
            $storedFile = $this->handleFileUpload($data['media']);
            $data['media'] = $storedFile->getFileName();
        }

        $createdAd = $this->ads->create($data);
        $matchedSoldiers = $this->users->getMatchedSoldiers($createdAd);

        // notify soldiers with matched visitors properties
        if ($createdAd) {
            Notification::send($matchedSoldiers, new AdCreated($createdAd));
        }
        app(FirebaseNotification::class)->sendPushNotification(
            [
                'fjJrQ0ZFB20:APA91bG4gwgEfQ-vE1noMu_uIwGK13oBS1PXXooSVJmPisq_Xm9qr13jJNmkjLg7S_3IfUIpahdiakTBWmrvTJ0tlCGI0r_u4biL2OUKc5gmsEqh12ljrQW61N4hCIca4YLgecTl4LB4'
            ],
            [],
            $createdAd->title,
            $createdAd->content
        );

        return new GenericPayload(
            [
                'message' => 'Ad created Successfully',
                'ad_id' => $createdAd->id,
                'checkout' => $this->createPaymentCheckout($createdAd)  // hyper pay
            ],
            201
        );
    }

    public function handleFileUpload($file)
    {
        return (new LocalFileUploadService($file))->saveMany();
    }

    public function createPaymentCheckout($createdAd)
    {
        $url = "https://test.oppwa.com/v1/checkouts";
        $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
                    "&amount=" . $createdAd->budget .
                    "&currency=SAR" .
                    "&paymentType=DB";
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                       'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;
    }
}
