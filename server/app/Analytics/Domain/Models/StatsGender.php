<?php

namespace App\Analytics\Domain\Models;

use App\Ads\Domain\Models\Ad;
use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Model;

class StatsGender extends Model
{
    public $table = 'stats_genders';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function ads()
    {
        return $this->belongsToMany(Ad::class, 'stats_gender_ad')->withPivot('visitors_number');
    }

    public function soldiers()
    {
        return $this->belongsToMany(User::class, 'stats_gender_soldier', 'stats_gender_id', 'soldier_id')->withPivot('visitors_number');
    }
}
