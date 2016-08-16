<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {
    public $timestamps = false;
    public function sales() {
        return $this->hasMany('App\Sale');
    }
}
