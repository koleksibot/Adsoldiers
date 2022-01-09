<?php

namespace App\Analytics\Domain\Models;

use App\Users\Domain\Models\User;
use Illuminate\Database\Eloquent\Model;

class SoldierAnalytic extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'age' => 'object',
        'gender' => 'object',
        'targeted_audience'=> 'object',
    ];
    public function user()
    {
        return  $this->hasOne(User::class, 'user_utm', 'utm');
    }
}
