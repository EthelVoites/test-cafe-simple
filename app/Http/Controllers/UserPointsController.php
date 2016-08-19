<?php

/**
 * User points system actions
 *
 */

namespace App\Http\Controllers;

use App\User;
use App\UserPoint;
use App\Http\Controllers\Controller;

class UserPointsController extends Controller
{
    /**
     * Add certain amount of points to user acount
     *
     * @param  int  $id
     * @param  int  $points
     * @return Response
     */
    public function add($id, $points)
    {
        if(ctype_digit($id) && ctype_digit($points)) {

            $userpoint = UserPoint::where('user_id', $id);

            $userpoint->increment('points', $points);

            $response = ['points' => $userpoint->value('points')];

        } else {
            $response = ['error' => 'id ning punktihulk peavad olema arvulised suurused'];
        }

        return \Response::json($response);
    }
}
