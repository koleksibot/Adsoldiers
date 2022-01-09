<?php

namespace App\Settings\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {
	protected $guarded = ['id'];
	public $timestamps = false;
}
