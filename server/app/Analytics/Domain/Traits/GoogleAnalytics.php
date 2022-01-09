<?php

namespace App\Analytics\Domain\Traits;

use Carbon\Carbon;
use Spatie\Analytics\Period;
use Spatie\Analytics\Analytics;

trait GoogleAnalytics
{
    protected $age;
    protected $gender;
    protected $interest;
    protected $visitors;
    protected $country;

    /**
     * Get the gender Analytics for spicific UTM
     *
     * @return Object $this->gender
     */
    public function getGenders()
    {
        $genderResponse = app(Analytics::class)->performQuery(
            Period::days(365),
            'ga:users',
            [
                'dimensions' => 'ga:userGender',
                'filters' => $this->filter,
            ]
        );
        if (isset($genderResponse['rows'])) {
            foreach ($genderResponse['rows'] as $row) {
                $this->gender[] = [
                    'value' => $row[0],
                    'visitors_number' => $row[1],
                ];
            };
        }

        return ($this->gender);
    }

    /**
     * Get the Age Analytics for spicific UTM
     *
     * @return Object $this->age
     */
    public function getAges()
    {
        $ageResponse = app(Analytics::class)->performQuery(
            Period::days(365),
            'ga:users,ga:sessions',
            [
                'dimensions' => 'ga:userAgeBracket',
                'filters' => $this->filter,
            ]
        );
        if (isset($ageResponse['rows'])) {
            foreach ($ageResponse['rows'] as $row) {
                $this->age[] = [
                    'value' => $row[0],
                    'visitors_number' => $row[1],
                ];
            };
        }

        return ($this->age);
    }

    /**
     * Get the  Targeted Audience Analytics for spicific UTM
     *
     * @return Object $this->interest
     */
    public function getTargetedAudience()
    {
        // Targeted Audience Analytics
        $interestResponse = app(Analytics::class)->performQuery(
            Period::days(365),
            'ga:sessions',
            [
                'dimensions' => 'ga:interestAffinityCategory',
                'filters' => $this->filter,
            ]
        );
        if (isset($interestResponse['rows'])) {
            foreach ($interestResponse['rows'] as $row) {
                $this->interest[] = [
                    'value' => $row[0],
                    'visitors_number' => $row[1],
                ];
            };
        }
        return ($this->interest);
    }

    /**
     * Get Country Analytics for spicific UTM
     *
     * @return Object $this->age
     */
    public function getCountries()
    {
        $countryResponse = app(Analytics::class)->performQuery(
            Period::days(365),
            'ga:users,ga:sessions',
            [
                'dimensions' => 'ga:country',
                'filters' => $this->filter,
            ]
        );
        if (isset($countryResponse['rows'])) {
            foreach ($countryResponse['rows'] as $row) {
                $this->country[] = [
                    'value' => $row[0],
                    'visitors_number' => $row[1],
                ];
            };
        }
        return ($this->country);
    }

    /**
     * Get the Number Of Visitors Analytics for spicific UTM
     *
     * @return Object $this->age
     */
    public function getTotalClicks()
    {
        $visitorResponse = app(Analytics::class)->performQuery(
            Period::days(365),
            'ga:users,ga:sessions',
            [
                'metrics' => 'ga:users',
                'filters' => $this->filter,
            ]
        );
        if (isset($visitorResponse['rows'])) {
            $this->visitors = $this->getFirstObject($visitorResponse['rows']);
        }
        return ($this->visitors);
    }

    /**
     * Get the Number Of Visitors Analytics for spicific UTM per current month
     *
     * @return Object $this->age
     */
    public function getCurrentMonthClicks()
    {
        $today = Carbon::today()->format('d');

        $visitorResponse = app(Analytics::class)->performQuery(
            Period::days($today),
            'ga:users,ga:sessions',
            [
                'metrics' => 'ga:users',
                'filters' => $this->filter,
            ]
        );
        if (isset($visitorResponse['rows'])) {
            $this->visitors = $this->getFirstObject($visitorResponse['rows']);
            return ($this->visitors);
        }
        return;
    }

    /**
     * Get the Number Of Visitors Analytics for spicific soldier UTM and Ad UTM
     * User balance for single ad
     *
     * @return Object $this->age
     */
    public function getUserAdBalance($filter)
    {
        // to test the method replace the days duration by 365
        $visitorResponse = app(Analytics::class)->performQuery(
            Period::days(1),
            'ga:users,ga:sessions',
            [
                'metrics' => 'ga:users',
                'filters' => $filter,
            ]
        );
        if (isset($visitorResponse['rows'])) {
            $this->visitors = $this->getFirstObject($visitorResponse['rows']);
        }
        return ($this->visitors);
    }

    public function getFirstObject(array $arr)
    {
        return head(head($arr));
    }
}
