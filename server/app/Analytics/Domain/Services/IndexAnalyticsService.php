<?php

namespace App\Analytics\Domain\Services;

use Analytics;
use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\Service;
use Spatie\Analytics\Period;

class IndexAnalyticsService extends Service
{
    public function handle($data = [])
    {
        // Gender Analytics
        $genderResponse = Analytics::performQuery(
            Period::days(365),
            'ga:users',
            [
                'dimensions' => 'ga:userGender',
            ]
        );
        foreach ($genderResponse['rows'] as $row) {
            $gender['gender'][] = [
                'value' => $row[0]
            ];
        };
        // Targeted Audience Analytics
        $interestResponse = Analytics::performQuery(
            Period::days(365),
            'ga:sessions',
            [
                'dimensions' => 'ga:interestAffinityCategory',
            ]
        );
        foreach ($interestResponse['rows'] as $row) {
            $interest['interest'][] = [
                'value' => $row[0]
            ];
        };
        // Age Analytics
        $ageResponse = Analytics::performQuery(
            Period::days(365),
            'ga:users,ga:sessions',
            [
                'dimensions' => 'ga:userAgeBracket',
            ]
        );
        foreach ($ageResponse['rows'] as $row) {
            $age['age'][] = [
                'value' => $row[0]
            ];
        };
        // Return Final Result
        $r = [
            'gender' => $gender['gender'],
            'age' => $age['age'],
            'interest' => $interest['interest'],
        ];

        return new GenericPayload($r);
    }
}
