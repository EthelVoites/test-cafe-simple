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
    const POINTS_PER_SALE = 1;

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
        $this->level = $this->countLevel();
        $this->save();
    }
    
    public function recountPoints()
    {
        $this->points = $this->countPoints();
        $this->save();
    }
    
    public function recountLevel()
    {
        $this->level = $this->countLevel();
        $this->save();
    }
    
    public function countPoints()
    {
        return $this->user->loyaltyLog->sum('points');
    }

    public function countLevel()
    {
        $level         = 0;
        $monthlyPoints = [];

        /** @var LoyaltyLog $item */
        foreach ($this->user->loyaltyLog as $item) {
            $month = $item->created_at->format('Y-m');

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