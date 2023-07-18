<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class RevalidateBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next,$guard = null)
    {
/* if(Auth::guard($guard)->guest()){if($request->ajax() || $request->wantsJson()){return respnse('Unauthorized.',401);}else{
return redirect()->guest('/home');}}*/ 
      $response = $next($request);
      return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')->header('Pragma','no-cache')
     ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
    }
}
