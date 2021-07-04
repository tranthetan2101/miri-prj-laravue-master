<?php

namespace App\Domains\Auth\Models\Traits\Relationship;

use App\Domains\Auth\Models\PasswordHistory;
use App\Models\CustomerAddr;
use App\Models\CustomerDetail;

/**
 * Class UserRelationship.
 */
trait UserRelationship
{
    /**
     * @return mixed
     */
    public function passwordHistories()
    {
        return $this->morphMany(PasswordHistory::class, 'model');
    }

    /**
     * @return mixed
     */
    public function customerDetail()
    {
        return $this->hasOne(CustomerDetail::class, 'user_id');
    }

    /**
     * @return mixed
     */
    public function customerAddrs()
    {
        return $this->hasMany(CustomerAddr::class, 'user_id');
    }
}
