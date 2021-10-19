<?php

namespace Hapidjus\ImpersonateUI;

use Illuminate\Foundation\Application;


class ImpersonateUi{

	private $app;
	private $manager;

	public function __construct(Application $app)
	{
		$this->app = $app;
	    $this->manager = $this->app['impersonate'];
	}

	public function userAllowedToImpersonate(){

		if(! auth()->user()){
			return false;
		}

		if($this->manager->isImpersonating()){
			return true;
		}

		if(! is_array(config('laravel-impersonate-ui.users_allowed_to_impersonate'))){
			return true;
		}

		return in_array(auth()->user()->email, config('laravel-impersonate-ui.users_allowed_to_impersonate'));

	}

	public function getImpersonator(){

	    if($this->manager->getImpersonatorId() !== null)
	    {
	        return config('laravel-impersonate-ui.user_model')::findOrFail($this->manager->getImpersonatorId());

	    }

	    return null;

	}

	public function makeTakeRedirectTo(){

		$takeRedirect = $this->getTakeRedirectTo(); 

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

		$leaveRedirect = $this->getLeaveRedirectTo();

		if ($leaveRedirect !== 'back') {

			return redirect()->to($leaveRedirect);

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

	static public function getUsers(){

		if(is_array(config('laravel-impersonate-ui.users_only'))){
			return config('laravel-impersonate-ui.user_model')::whereIn('id', config('laravel-impersonate-ui.users_only'))->orderBy('name')->get();
		}

		if(is_array(config('laravel-impersonate-ui.users_exclude'))){
			return config('laravel-impersonate-ui.user_model')::whereNotIn('id', config('laravel-impersonate-ui.users_exclude'))->orderBy('name')->get();
		}

		return config('laravel-impersonate-ui.user_model')::orderBy('name')->get();

	}

}