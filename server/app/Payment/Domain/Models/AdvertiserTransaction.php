<?php

namespace App\Payment\Domain\Models;

use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Model;

class AdvertiserTransaction extends Model
{
    protected $table = 'advertiser_transaction';
    protected $guarded = ['id',	'created_at',	'updated_at'];

    public function advertiser()
    {
        return $this->belongsTo(User::class, 'advertiser_id', 'id');
    }
}
