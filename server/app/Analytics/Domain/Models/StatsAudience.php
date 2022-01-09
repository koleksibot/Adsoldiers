<?php

namespace App\Analytics\Domain\Models;

use App\Ads\Domain\Models\Ad;
use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Model;

class StatsAudience extends Model
{
    public $table = 'stats_audience';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function ads()
    {
        return $this->belongsToMany(Ad::class, 'stats_audience_ad')->withPivot('visitors_number');
    }

    public function soldiers()
    {
        return $this->belongsToMany(User::class, 'stats_audience_soldier', 'stats_audience_id', 'soldier_id')->withPivot('visitors_number');
    }
}
