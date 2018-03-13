<?php
namespace App\Http\Middleware;
use Closure;
use Auth;
class AdminMiddleware
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
        if(!Auth::check() || Auth::user()->type_id == 2){
        	// route to not an admin page
            return redirect()->route('employees');
        }
        return $next($request);
    }
}