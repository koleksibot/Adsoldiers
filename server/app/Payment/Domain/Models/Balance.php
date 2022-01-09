<?php

namespace App\Payment\Domain\Models;

use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $guarded = ['id',	'created_at',	'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
