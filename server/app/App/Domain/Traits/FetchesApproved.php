<?php

namespace App\App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait FetchesApproved
{
    public function scopeApproved(Builder $builder)
    {
        return $builder->whereNotNull('approved_at');
    }
    public function scopeDisapproved(Builder $builder)
    {
        return $builder->whereNull('approved_at');
    }
    public function isApproved()
    {
        return !!$this->approved_at;
    }
    public function isNotApproved()
    {
        return !$this->isApproved();
    }

    public function removeExpired()
    {
        return $this->disapproved()->where('created_at', '<=', now()->subDays(config('adsoldiers.approval.expiration')))->get()->each->delete();
    }
}
