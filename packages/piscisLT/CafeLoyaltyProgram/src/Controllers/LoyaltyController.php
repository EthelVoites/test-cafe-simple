<?php

namespace piscisLT\CafeLoyaltyProgram\Controllers;

use piscisLT\CafeLoyaltyProgram\Models\LoyaltyLog;
use piscisLT\CafeLoyaltyProgram\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

/**
 * Class LoyaltyController
 * @package piscisLT\CafeLoyaltyProgram\Controllers
 * @author  David Gegelija <code@imdavid.xyz>
 */
class LoyaltyController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            View::share('loyaltyMenu', $this->menu());

            return $next($request);
        });
    }

    private function menu()
    {
        $currentRoute = str_replace('loyalty.', '', Route::currentRouteName());
        $menu         = [
            'user_log' => [
                'title'    => 'User: '.Auth::user()->name,
                'url'      => route('loyalty.user_log', Auth::user()->id),
                'btnClass' => 'default',
            ],
            'all'      => [
                'title'    => 'All',
                'url'      => route('loyalty.all'),
                'btnClass' => 'default',
            ],
        ];
        if (array_key_exists($currentRoute, $menu)) {
            $menu[$currentRoute]['btnClass'] = 'info';
        }

        return $menu;
    }

    public function list()
    {
        $users = User::all();

        return view('loyalty_program::list', compact('users'));
    }

    public function addPoints($userId, Request $request)
    {
        $this->validate($request, [
            'points' => 'required|integer|max:10',
        ]);

        /** @var User $user */
        $user = User::findOrFail($userId);

        $logItem = new LoyaltyLog([
            'user_id'       => $user->id,
            'points'        => Input::get('points'),
            'action'        => LoyaltyLog::ADMIN_ACTION,
            'loggable_id'   => Auth::user()->id,
            'loggable_type' => get_class(Auth::user()),
        ]);
        $logItem->save();

        return Redirect::back()->with('message', 'Points added!');
    }

    public function userLog($userId = null)
    {
        $userId = $userId ? $userId : Auth::user()->id;
        $user   = User::findOrFail($userId);

        return view('loyalty_program::log', compact('user'));
    }
}