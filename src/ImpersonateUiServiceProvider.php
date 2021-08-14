<?php

namespace Hapidjus\ImpersonateUI;


use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Hapidjus\ImpersonateUI\ImpersonateUi;
use Hapidjus\ImpersonateUI\Middlewares\ImpersonateUiMiddleware;



class ImpersonateUiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'impersonate-ui');

        $this->publishes([
            __DIR__.'/../config/laravel-impersonate-ui.php' => config_path('laravel-impersonate-ui.php'),
        ], 
            'config'
        );

    	$this->publishes([
            __DIR__.'/../resources/views' =>  resource_path('views/vendor/impersonate-ui'),
        ], 
            'view'
        );
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {

        $this->mergeConfig();

        if(! $this->isEnabled()){
            return;
        }

        $this->app->singleton(ImpersonateUi::class, function ($app) {
            return new ImpersonateUi($app);
        });
        $this->app->alias(ImpersonateUi::class, 'impersonateUi');


        app('Illuminate\Contracts\Http\Kernel')->pushMiddleware(ImpersonateUiMiddleware::class);
        
        $this->registerViewComposer();

        $this->registerRoutes();


    }

    protected function registerViewComposer()
    {
        View::composer('impersonate-ui::impersonate-ui', function ($view) {
        
            $view->with([
                'impersonator'  => app('impersonate')->getImpersonator(),
                'users'         => ImpersonateUi::getUsers()
            ]);

        });

    }

    protected function isEnabled()
    {
        return config('laravel-impersonate-ui.enabled', false);
    }

    protected function registerRoutes()
    {
		$this->loadRoutesFrom(__DIR__.'/Routes/ImpersonateUiRoutes.php');
    }

    protected function mergeConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-impersonate-ui.php', 'laravel-impersonate-ui');
    }

}
