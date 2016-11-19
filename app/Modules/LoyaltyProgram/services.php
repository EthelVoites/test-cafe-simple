<?php

namespace App\Modules\LoyaltyProgram;

use App\Modules\LoyaltyProgram\Models\LoyaltyLog;
use App\Sale;

Sale::created(function (Sale $sale) {
    $loyaltyLogItem = new LoyaltyLog([
        'user_id'       => $sale->user->id,
        'points'        => LoyaltyLog::POINTS_PER_SALE,
        'action'        => LoyaltyLog::SALE_ACTION,
        'loggable_id'   => $sale->id,
        'loggable_type' => Sale::class,
    ]);
    $loyaltyLogItem->save();
});

LoyaltyLog::created(function (LoyaltyLog $item) {
    $item->recountUserPoints();
});