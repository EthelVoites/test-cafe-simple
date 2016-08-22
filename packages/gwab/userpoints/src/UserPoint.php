<?php

namespace Gwab\Userpoints;

use Illuminate\Database\Eloquent\Model;

class UserPoint extends Model
{
    public $timestamps = false;
    //
    protected $fillable = ['level','points'];

    protected $table = 'user_points';

    private $rules = [
        'user_id' => 'integer|min:0',
        'level' => 'integer|min:0',
        'points' => 'integer|min:0'
    ];

    public function validate($data)
    {
        // make a new validator object
        $v = Validator::make($data, $this->rules);
        // check for failure
        if ($v->fails())
        {
            // set errors and return false
            $this->errors = $v->errors;
            return false;
        }

        // validation pass
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
}
