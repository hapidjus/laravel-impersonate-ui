<?php

namespace Hapidjus\ImpersonateUI;

use Illuminate\Support\ServiceProvider;
use Riak\Connection;

class ImpersonateUiServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        return true;
    }
}