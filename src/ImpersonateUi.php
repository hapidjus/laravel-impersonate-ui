<?php

namespace Hapidjus\ImpersonateUI;

use Illuminate\Foundation\Application;
use App\User;

class ImpersonateUi{

	private $app;
	private $manager;

	public function __construct(Application $app)
	{
		$this->app = $app;
	    $this->manager = $this->app['impersonate'];
	}

	public function getImpersonator(){

	    if($this->manager->getImpersonatorId() !== null)
	    {
	        return User::findOrFail($this->manager->getImpersonatorId());

	    }

	    return null;

	}

	public function makeTakeRedirectTo(){

        if ($this->getTakeRedirectTo() !== 'back') {
        
            return redirect()->to($takeRedirect);
        
        }
        
        return back();

	}
	public function getTakeRedirectTo(){

		try {

			$uri = route(config('laravel-impersonate-ui.take_redirect_to'));

		} catch (\InvalidArgumentException $e) {

			$uri = config('laravel-impersonate-ui.take_redirect_to');

		}

		return $uri;

	}

	public function makeLeaveRedirectTo(){

		$takeRedirect = $this->getLeaveRedirectTo();

		if ($takeRedirect !== 'back') {

			return redirect()->to($takeRedirect);

		}

		return back();

	}

	public function getLeaveRedirectTo(){

		try {

			$uri = route(config('laravel-impersonate-ui.leave_redirect_to'));

		} catch (\InvalidArgumentException $e) {

			$uri = config('laravel-impersonate-ui.leave_redirect_to');

		}

		return $uri;
	}

}