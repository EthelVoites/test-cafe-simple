<?php

namespace piscisLT\CafeLoyaltyProgram\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserLoyalty
 * @package piscisLT\CafeLoyaltyProgram\Models
 * @author  David Gegelija <code@imdavid.xyz>
 *
 * @property integer id
 * @property integer $user_id
 * @property integer $points
 * @property integer $level
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 *
 * @property User    $user
 */
class UserLoyalty extends Model
{
    const POINTS_PER_LEVEL = 5;

    protected $fillable = ['user_id', 'points', 'level'];

    protected $attributes
        = [
            'points' => 0,
            'level'  => 0,
        ];

    public function user()
    {
        return $this->belongsTo('piscisLT\CafeLoyaltyProgram\Models\User');
    }

    public function recountAll()
    {
        $this->points = $this->countPoints();
        $this->level  = $this->countLevel();
        $this->save();
    }

    public function recountPoints()
    {
        $this->points = $this->countPoints();
        $this->save();
    }

    public function recountLevel($skipCurrentMonth = false)
    {
        $this->level = $this->countLevel($skipCurrentMonth);
        $this->save();
    }

    public function countPoints()
    {
        $startingFrom = date('Y-m-d 00:00:00', strtotime('first day of this month'));
        return $this->user->loyaltyLog->where('created_at', '>=', $startingFrom)->sum('points');
    }
    
    public function countAllPoints()
    {
        return $this->user->loyaltyLog->sum('points');
    }

    public function countLevel($skipCurrentMonth = false)
    {
        $level         = 0;
        $monthlyPoints = [];
        $currentMonth  = date('Y-m');

        /** @var LoyaltyLog $item */
        foreach ($this->user->loyaltyLog as $item) {
            $month = $item->created_at->format('Y-m');

            if ($skipCurrentMonth && $month == $currentMonth) {
                continue;
            }

            if (!array_key_exists($month, $monthlyPoints)) {
                $monthlyPoints[$month] = $item->points;
            } else {
                $monthlyPoints[$month] += $item->points;
            }
        }

        foreach ($monthlyPoints as $points) {
            $level += (int)floor($points / static::POINTS_PER_LEVEL);
        }

        return $level;
    }
}