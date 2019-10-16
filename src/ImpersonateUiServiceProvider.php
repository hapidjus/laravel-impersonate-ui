<?php

namespace Hapidjus\ImpersonateUI;

use Illuminate\Support\ServiceProvider;
use Riak\Connection;
use Hapidjus\ImpersonateUI\Middlewares\ImpersonateUiMiddleware;
use Illuminate\Support\Facades\View;
use App\User;



class ImpersonateUiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laravel-impersonate-ui.php' => config_path('laravel-impersonate-ui.php'),
        ]);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {

        app('Illuminate\Contracts\Http\Kernel')->pushMiddleware(ImpersonateUiMiddleware::class);
        
        $this->registerViews();

        $this->registerRoutes();

        $this->mergeConfig();

    }

    protected function registerViews()
    {
    	$this->loadViewsFrom(__DIR__ . '/../resources/views', 'impersonate-ui');
        View::composer('impersonate-ui::impersonate-ui', function ($view) {
            $view->with([
                'impersonator'  => $this->getImpersonator(),
                'users'         => User::orderBy('name')->get()
            ]);
        });
    }

    protected function registerRoutes()
    {
		$this->loadRoutesFrom(__DIR__.'/Routes/ImpersonateUiRoutes.php');
    }

    protected function mergeConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-impersonate-ui.php', 'laravel-impersonate-ui');
    }

    public function getImpersonator(){

        $manager = app('impersonate');

        if($manager->getImpersonatorId() !== null)
        {
            return User::findOrFail($manager->getImpersonatorId());

        }

        return null;

    }

}