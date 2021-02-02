<? php
namespace App\Http\Middleware;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
   	 protected function redirectTo($request)
   	 {
    		if (! $request->expectsJson()) {
            		return route('login');
    	    	}
    	}
        
      	public function handle($request, Closure $next, $guard = null)
    	{
        		if (!Auth::check()) {
			
			Session::flash('message', trans('errors.session_label'));
          			 Session::flash('type', 'warning');
			 return redirect()->route('/');
		}
   	 }
   	 protected function nocache($response)
	    {
	        $response->headers->set('Cache-Control','nocache, no-store, max-age=0, must-revalidate');
	        $response->headers->set('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
	        $response->headers->set('Pragma','no-cache');

	        return $response;
	    }
}