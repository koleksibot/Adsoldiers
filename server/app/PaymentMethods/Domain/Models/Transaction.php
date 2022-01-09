<?php

namespace App\Payment\Domain\Models;

use App\OurEdu\Users\User;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['id',	'created_at',	'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
