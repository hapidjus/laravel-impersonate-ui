<?php

namespace Hapidjus\ImpersonateUI\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Auth\AuthManager;
use App\User;
use Auth;

class ImpersonateUiController extends Controller
{

	private $manager;

	public function __construct(){

		$this->manager = app('impersonate');

	}

    public function take(Request $request)
    {

    	
    	if($this->manager->isImpersonating())
    	{
    		$this->manager->leave();
    	}

    	$this->manager->take(Auth::user(), $this->manager->findUserById($request->impersonate_id));

    	return redirect()->back();

    }

    public function leave(Request $request)
    {

		if($this->manager->isImpersonating())
		{
			$this->manager->leave();
		}    	

    	return redirect()->back();

    }


}
