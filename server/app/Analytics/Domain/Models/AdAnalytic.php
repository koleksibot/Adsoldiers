<?php

namespace App\Analytics\Domain\Models;

use App\Ads\Domain\Models\Ad;
use Illuminate\Database\Eloquent\Model;

class AdAnalytic extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'age' => 'array',
        'country' => 'array',
        'gender' => 'array',
        'targeted_audience' => 'array',
    ];

    public function ad()
    {
        return  $this->hasOne(Ad::class, 'ad_id', 'id');
    }
}
