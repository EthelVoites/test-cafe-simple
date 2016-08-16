<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model {

    public $timestamps = false;

    public function user() {
        $this->belongsTo('App\User');
    }

    public function item() {
        $this->belongsTo('App\Item');
    }
}
