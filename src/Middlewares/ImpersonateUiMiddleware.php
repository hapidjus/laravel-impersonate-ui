<?php

namespace Hapidjus\ImpersonateUI\Middlewares;

use Closure;
use Illuminate\Support\Str;



class ImpersonateUiMiddleware
{
	/**
	 * The impersonate UI manager instance.
	 *
	 * @var mixed
	 */
	protected $uiManager;

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
	
		$response = $next($request);

		if(! config('laravel-impersonate-ui.global_include')){
			return $response;
		}

		if (! Str::contains($response->headers->get('Content-Type'), 'text/html')) {
			return $response;
		}

        $this->uiManager = app('impersonateUi');

		if(! $this->uiManager->userAllowedToImpersonate()){
			return $response;
		}

		$content = $response->getContent();

		if (($head = mb_strpos($content, '</body>')) !== false) {

			$response->setContent(mb_substr($content, 0, $head) .
				view('impersonate-ui::impersonate-ui') .
				mb_substr($content, $head));

		}

		return $response;

	}

	public function getImpersonator(){

		$manager = app('impersonate');

		if($manager->getImpersonatorId() !== null)
		{
			return config('laravel-impersonate-ui.user_model')::findOrFail($manager->getImpersonatorId());

		}

		return null;

	}
}