<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class GeoIp extends Model
{
    /**
     * Scope a query to only include popular users.
     *
     * @param Builder $query
     * @param string $ip
     * @return Builder
     */
    public function scopeIpAddressInformation(Builder $query, string $ip)
    {
        return $query->where('ip', $ip)->first();
    }
}
