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

        $this->addMiddleware();

        $this->addScheduler();

        $this->addViews();

        $this->setupAssets();
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->registerRoutes();
    }


    /**
     * Publish the migrations for the package
     */
    public function setupMigrations()
    {
        // Use this if your package publishes migration files.
        $this->publishes([
            __DIR__ . '/database/migrations/' => database_path('migrations')
        ], 'migrations');
    }


    public function setupSeeds() 
    {
        $this->publishes([
            __DIR__ . '/database/seeds/' => database_path('seeds')
        ], 'seeds');
    }


    public function addMiddleware()
    {
        $router = $this->app['router'];
        $router->middleware('userpoints', UserPointsMiddleware::class);
    }


    //Scheduler
    // Monthly user point account update
    // Calculate user point level based on number of points
    public function addScheduler()
    {
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


    public function addViews()
    {
        $paths = \Config::get('view.paths');
        array_unshift($paths, __DIR__ . '/views');
        \Config::set('view.paths', $paths);
    }


    public function setupAssets()
    {
        $this->publishes([
            __DIR__ . '/public/' => public_path('gwab/userpoints')
        ], 'public');
    }


    public function registerRoutes()
    {
        include __DIR__ . '/routes.php';
        $this->app->make('Gwab\Userpoints\UserPointsController');
    }
}
