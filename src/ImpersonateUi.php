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

	public function getTakeRedirectTo(){

		$takeRedirect = $this->manager->getTakeRedirectTo();
        
        if ($takeRedirect !== 'back') {
        
            return redirect()->to($takeRedirect);
        
        }
        
        return back();

	}

	public function getLeaveRedirectTo(){

		$takeRedirect = $this->manager->getLeaveRedirectTo();
        
        if ($takeRedirect !== 'back') {
        
            return redirect()->to($takeRedirect);
        
        }
        
        return back();

	}
}