<?php

namespace App\Payment\Domain\Models;

use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Model;

class SoldierTransaction extends Model
{
    protected $table = 'soldier_transaction';
    protected $guarded = ['id',	'created_at',	'updated_at'];

    public function soldier()
    {
        return $this->belongsTo(User::class, 'soldier_id', 'id');
    }
}
