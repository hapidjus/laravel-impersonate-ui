<?php

namespace Hapidjus\ImpersonateUI\Middlewares;

use Closure;
use Illuminate\Support\Str;
use App\User;

class ImpersonateUiMiddleware
{
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

		$users = User::orderBy('name')->get();

		$impersonator = $this->getImpersonator();

		if (Str::contains($response->headers->get('Content-Type'), 'text/html')) {

			$content = $response->getContent();

			if (($head = mb_strpos($content, '</body>')) !== false) {

				$response->setContent(mb_substr($content, 0, $head) .
					view('impersonate-ui::impersonate-ui', compact('users', 'impersonator')) .
					mb_substr($content, $head));

			}

		}

		return $response;
	}

	public function getImpersonator(){

		$manager = app('impersonate');
		
		if($manager->getImpersonatorId() !== null)
		{
			return User::findOrFail($manager->getImpersonatorId());

		}

		return null;

	}
}