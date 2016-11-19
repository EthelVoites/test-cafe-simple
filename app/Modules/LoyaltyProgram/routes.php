<?php

Route::group(
    ['prefix' => 'loyalty', 'namespace' => 'App\Modules\LoyaltyProgram\Controllers', 'middleware' => ['web', 'auth']],
    function () {
        Route::get('/all', 'LoyaltyController@list')
            ->name('loyalty.all');

        Route::get('/{user_id?}', 'LoyaltyController@userLog')
            ->name('loyalty.user_log')
            ->where('user_id', '[0-9]+');

        Route::post('/add/{user_id}', 'LoyaltyController@addPoints')
            ->name('loyalty.add_points')
            ->where('user_id', '[0-9]+');
    }
);

