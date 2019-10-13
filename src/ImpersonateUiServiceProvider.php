<?php

namespace Hapidjus\ImpersonateUI;

use Illuminate\Support\ServiceProvider;
use Riak\Connection;
use Hapidjus\ImpersonateUI\Middlewares\ImpersonateUiMiddleware;


class ImpersonateUiServiceProvider extends ServiceProvider
{
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

    }

    protected function registerViews()
    {
    	$this->loadViewsFrom(__DIR__ . '/../resources/views', 'impersonate-ui');
    }

    protected function registerRoutes()
    {
		$this->loadRoutesFrom(__DIR__.'/Routes/ImpersonateUiRoutes.php');
    }
}