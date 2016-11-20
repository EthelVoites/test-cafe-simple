<?php

namespace piscisLT\CafeLoyaltyProgram;

use App\Sale;
use Illuminate\Support\ServiceProvider;
use piscisLT\CafeLoyaltyProgram\Commands\LoyaltyLevels;
use piscisLT\CafeLoyaltyProgram\Models\LoyaltyLog;
use piscisLT\CafeLoyaltyProgram\Commands\LoyaltySales;

class CafeLoyaltyProgramServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    public function boot()
    {
        $this->registerDefaults();
        $this->registerEvents();
        $this->registerCommands();
    }

    public function registerDefaults()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'loyalty_program');

        if (!$this->app->routesAreCached()) {
            require __DIR__.'/routes/web.php';
        }

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/loyalty_program'),
        ]);
    }

    public function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands(
                LoyaltySales::class,
                LoyaltyLevels::class
            );
        }
    }

    public function registerEvents()
    {
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
    }
}