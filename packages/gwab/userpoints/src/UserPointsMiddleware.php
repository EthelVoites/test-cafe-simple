<?php

/**
 * Middleware that increments +1 to present user's 
 * userpoint account each time it is called.
 * To add it to certain action modify app/http/routes.php appending
 * ->middleware(['userpoint']) after the route definition.
 * For example: 
 * Route::get('/buy/{item}', 'HomeController@getBuy')->middleware(['userpoint']);
*/

namespace Gwab\Userpoints;

use Closure;

class UserPointsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        UserPoint::where('user_id', \Auth::user()->id)->increment('points');

        return $next($request);
    }
}
