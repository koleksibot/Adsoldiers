<?php

namespace App\Campaigns\Domain\Models;

use App\Ads\Domain\Models\Ad;
use App\Ads\Domain\Models\Currency;
use App\Users\Domain\Models\Company;
use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    // protected $table = 'ads';
    protected $dates = [
        'end_date', 'start_date',
        'created_at',
        'updated_at',
    ];
    
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getStatusAttribute($value)
    {
        return $value == "0" ? 'Paused' : 'Active';
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'ad_user', 'user_id', 'ad_id');
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    public function ads()
    {
        return $this->hasMany(Ad::class, 'campaign_id', 'id');
    }
}
