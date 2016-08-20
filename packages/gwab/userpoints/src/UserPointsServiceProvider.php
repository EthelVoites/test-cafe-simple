<?php

namespace Gwab\Userpoints;

use Illuminate\Support\ServiceProvider;
use \Illuminate\Console\Scheduling\Schedule;

class UserPointsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->setupMigrations();

        $router = $this->app['router'];
        $router->middleware('userpoints', UserPointsMiddleware::class);

        //Scheduler
        // Monthly user point account update
        // Calculate user point level based on number of points
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->call(function(){
                $rate = 5;
                \DB::table('user_points')->update([
                   'level' => \DB::raw('round(points/' . $rate . ')'),
                   'points' => 0
                ]);
            })->monthly();
        });
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        include __DIR__ . '/routes.php';
        $this->app->make('Gwab\Userpoints\UserPointsController');
    }


    /**
     * Publish the migrations for the package
     */
    public function setupMigrations()
    {
        // Use this if your package publishes migration files.
        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations')
        ], 'migrations');
    }

}
