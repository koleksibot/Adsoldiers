<?php

namespace App\Analytics\Domain\Models;

use App\Ads\Domain\Models\Ad;
use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Model;

class StatsAge extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];

    public function ads()
    {
        return $this->belongsToMany(Ad::class, 'stats_age_ad')->withPivot('visitors_number');
    }

    public function soldiers()
    {
        return $this->belongsToMany(User::class, 'stats_age_soldier', 'stats_age_id', 'soldier_id')->withPivot('visitors_number');
    }
}
