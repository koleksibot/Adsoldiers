<?php

namespace App\Ads\Domain\Policies;

use App\Users\Domain\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdPolicy {
	use HandlesAuthorization;

	public function create(User $user) {
		return $user->hasRole('create-ad');
	}
	public function delete(User $user) {
		return $user->hasRole('delete-ad');
	}
	public function update(User $user) {
		return $user->hasRole('update-ad');
	}
}