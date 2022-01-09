<?php

namespace App\Ads\Domain\Models;

use App\Ads\Domain\Models\Ads;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model {
	protected $guarded = [
		'id',
		'created_at',
		'updated_at',
	];

	public function ads() {
		return $this->hasMany(Ad::class, 'currency_id', 'id');
	}
}
