<?php

namespace piscisLT\CafeLoyaltyProgram\Models;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class User
 * @package piscisLT\CafeLoyaltyProgram\Models
 * @author  David Gegelija <code@imdavid.xyz>
 *
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 *
 * @property Collection  $loyaltyLog
 * @property UserLoyalty $loyalty
 */
class User extends \App\User
{
    public function loyalty()
    {
        return $this->hasOne('piscisLT\CafeLoyaltyProgram\Models\UserLoyalty');
    }

    public function loyaltyLog()
    {
        return $this->hasMany('piscisLT\CafeLoyaltyProgram\Models\LoyaltyLog');
    }

    public function loyaltyOrNew()
    {
        if (!$this->loyalty) {
            $this->loyalty          = new UserLoyalty;
            $this->loyalty->user_id = $this->id;
        }

        return $this->loyalty;
    }
}