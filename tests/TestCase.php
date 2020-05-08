<?php

namespace Hapidjus\ImpersonateUI\Test;

use Hapidjus\ImpersonateUI\Test\Stubs\User;
use Hapidjus\ImpersonateUI\ImpersonateUiServiceProvider;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{

	protected $user;

	protected function setUp(): void
	{
	    parent::setUp();
	    $this->withFactories(__DIR__.'/factories');
	    //$this->loadLaravelMigrations();

	    $this->loadMigrationsFrom(__DIR__.'/migrations');
	    $this->app['router']->impersonate();


        $this->user = factory(User::class)->create();

	}

    protected function getPackageProviders($app)
    {
        return [
        	ImpersonateUiServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $config = $app->make('config');
        $config->set('auth.providers.users.model', User::class);

        $config->set('database.default', 'testbench');
        $config->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }
}
