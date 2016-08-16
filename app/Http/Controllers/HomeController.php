<?php

namespace App\Http\Controllers;

use App\Item;
use App\Sale;
use App\User;
use Carbon\Carbon;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $items = Item::all();

        return view('home', ['items' => $items]);
    }

    public function getBuy(Item $item) {
        $sale = new Sale();
        $sale->item_id = $item->id;
        $sale->user_id = \Auth::id();
        $sale->sale_time = Carbon::now();
        $sale->save();

        return view('bought', ['item' => $item]);
    }

    public function getBackoffice() {
        $users = User::all();

        return view('backoffice', ['users' => $users]);
    }
}
