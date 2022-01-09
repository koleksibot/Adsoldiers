<?php

namespace App\Libraries\Domain\Policies;

use App\Users\Domain\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LibraryPolicy {

	use HandlesAuthorization;

	public function create(User $user) {
		return $user->hasRole('create-library');
	}
}