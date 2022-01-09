<?php

namespace App\Campaigns\Domain\Policies;

use App\Users\Domain\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CampaignPolicy
{
	use HandlesAuthorization;

	public function create(User $user)
	{
		return $user->hasRole('create-campaign');
	}
	public function update(User $user)
	{
		return $user->hasRole('update-campaign');
	}
	public function delete(User $user)
	{
		return $user->hasRole('delete-campaign');
	}
}
