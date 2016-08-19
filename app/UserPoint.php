<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPoint extends Model
{
    public $timestamps = false;
    //
    protected $fillable = ['level','points'];

    protected $table = 'user_points';
}
