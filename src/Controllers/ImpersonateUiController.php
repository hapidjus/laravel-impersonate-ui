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
    private $uiManager;

	public function __construct(){

		$this->manager = app('impersonate');
        $this->uiManager = app('impersonateUi');

	}

    public function take(Request $request)
    {

        if (! $request->user()->canImpersonate()) {
            abort(403);
        }
    	
    	if($this->manager->isImpersonating())
    	{
    		$this->manager->leave();
    	}

        $userToImpersonate = $this->manager->findUserById($request->impersonate_id);

        if ($userToImpersonate->canBeImpersonated()) {

            $this->manager->take($request->user(), $userToImpersonate);

        }

        return $this->uiManager->makeTakeRedirectTo();

    }

    public function leave(Request $request)
    {

		if($this->manager->isImpersonating())
		{

			$this->manager->leave();

		}    	

        return $this->uiManager->makeLeaveRedirectTo();

    }


}
