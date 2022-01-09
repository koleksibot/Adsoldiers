<?php

namespace App\Tasks\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['media' => 'array'];
}
