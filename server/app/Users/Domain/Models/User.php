<?php

namespace App\Users\Domain\Models;

use App\Ads\Domain\Models\Ad;
use Artify\Artify\Traits\Roles\Roles;
use App\Payment\Domain\Models\Balance;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use App\Analytics\Domain\Models\StatsAge;
use App\Campaigns\Domain\Models\Campaign;
use App\Analytics\Domain\Models\StatsGender;
use App\Analytics\Domain\Models\StatsAudience;
use App\Analytics\Domain\Models\SoldierAnalytic;
use App\Payment\Domain\Models\SoldierTransaction;
use App\PaymentMethods\Domain\Models\PaymentMethod;
use App\Payment\Domain\Models\AdvertiserTransaction;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\App\Domain\Notifications\Models\DatabaseNotification;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, Roles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * if the value of utm is empty in the Database return empty string
     * @param  [type] $value [value of the attribute in the database]
     * @return [type] [string]
     */
    public function getUtmAttribute($value)
    {
        if ($value == null) {
            return '';
        }
        return $value;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function isActivated()
    {
        return $this->activation()->whereNotNull('completed_at')->exists();
    }

    public function generateAuthToken()
    {
        return \JWTAuth::fromUser($this);
    }

    public function reminder()
    {
        return $this->hasOne(Reminder::class, 'user_id', 'id');
    }

    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class, 'user_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function campaigns()
    {
        return $this->hasMany(campaign::class, 'owner_id', 'id');
    }

    public function soldierCampaigns()
    {
        return $this->belongsToMany(Campaign::class, 'ad_user', 'user_id', 'ad_id');
    }

    public function activation()
    {
        return $this->hasOne(Activation::class, 'user_id', 'id');
    }

    public function balance()
    {
        return $this->hasOne(Balance::class, 'user_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function ads()
    {
        return $this->hasMany(Ad::class, 'advertiser_id', 'id');
    }

    public function soldierAds()
    {
        return $this->belongsToMany(Ad::class, 'ad_user', 'soldier_id', 'ad_id')->withPivot(['profit', 'reached_limit_at']);
    }

    public function advertiserTransactions()
    {
        return $this->hasMany(AdvertiserTransaction::class, 'advertiser_id', 'id');
    }

    public function soldierTransactions()
    {
        return $this->hasMany(SoldierTransaction::class, 'soldier_id', 'id');
    }

    public function statistic()
    {
        return $this->hasOne(SoldierAnalytic::class, 'user_utm', 'utm');
    }

    public function statsAges()
    {
        return $this->belongsToMany(StatsAge::class, 'stats_age_soldier', 'soldier_id')->withPivot('visitors_number');
    }

    public function statsAudience()
    {
        return $this->belongsToMany(StatsAudience::class, 'stats_audience_soldier', 'soldier_id', 'stats_audience_id')->withPivot('visitors_number');
    }

    public function statsGenders()
    {
        return $this->belongsToMany(StatsGender::class, 'stats_gender_soldier', 'soldier_id')->withPivot('visitors_number');
    }

    /**
     * Get the entity's notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notifications()
    {
        return $this->morphMany(DatabaseNotification::class, 'notifiable')->orderBy('created_at', 'desc');
    }
}
