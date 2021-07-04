<?php

namespace App\Models\Auth\Traits\Relationship;

use App\Models\Auth\PasswordHistory;
use App\Models\Auth\SocialAccount;
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
    public function providers()
    {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * @return mixed
     */
    public function passwordHistories()
    {
        return $this->hasMany(PasswordHistory::class);
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
