<?php namespace App\Http\Middleware;

use Closure;

class SuperAdmin {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (! $request->user()->isSuperAdmin()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                $request->session()->flash('error', '<strong>' . trans('errors.unauthorized') . ':</strong>' .  trans('errors.no_permission_to_access_page_or_action'));

                return redirect()->route('accounting.transaction.index');
            }
        }

        return $next($request);
	}

}
