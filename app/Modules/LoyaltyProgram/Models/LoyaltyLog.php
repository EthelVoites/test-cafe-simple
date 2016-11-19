<?php

namespace App\Modules\LoyaltyProgram\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LoyaltyLog
 * @package App\Modules\LoyaltyProgram\Models
 * @author  David Gegelija <code@imdavid.xyz>
 *
 * @property integer $user_id
 * @property integer $points
 * @property string  $action
 * @property integer $loggable_id
 * @property string  $loggable_type
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 *
 * @property User    $user
 */
class LoyaltyLog extends Model
{
    const POINTS_PER_SALE = 1;

    const ADMIN_ACTION = 'Manual add';
    const SALE_ACTION = 'Sale';

    protected $table = 'loyalty_log';
    protected $fillable = ['user_id', 'points', 'action', 'loggable_id', 'loggable_type'];

    public function user()
    {
        return $this->belongsTo('App\Modules\LoyaltyProgram\Models\User');
    }

    public function recountUserPoints()
    {
        $this->user->loyaltyOrNew()->recountPoints();
    }

    public function loggable()
    {
        return $this->morphTo();
    }
}