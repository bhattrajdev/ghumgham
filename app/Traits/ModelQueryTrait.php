<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ModelQueryTrait
{
    /**
     * @method static Builder active()
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', '=', '1');
    }


    /**
     * @method static Builder acceptedAndActive()
     */
    public function scopeAcceptedAndActive(Builder $query): Builder
    {
        return $query->where('status', '=', '1')
                     ->where('phase', '=', 'accepted');
    }
}
