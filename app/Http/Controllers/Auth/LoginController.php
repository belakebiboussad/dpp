<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\modeles\Etablissement;
use Auth;
use Redirect;//use config;
use Config;
use Session;
use Cache;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
      public function __construct()
      {
        // $this->middleware('auth');
        $this->middleware('guest')->except('logout');
      }
      //abm
      protected function validator(array $data)
      {       
              $validator = Validator::make($data, [
              'name' => 'required|max:255',
              'password' => 'required|confirmed|min:1',
              ]);
              return $validator;
      }
      protected function getFailedLoginMessage()
      {
        return 'what you want here.';
      }
      protected function credentials(Request $request)
      {
        $credentials = $request->only($this->username(), 'password');
        $credentials['active'] = 1;
        return $credentials;
      }
      protected function sendFailedLoginResponse(Request $request)
      {
        $errors = [$this->username() => trans('auth.failed')];// Load user from database
        $user = \App\User::where($this->username(), $request->{$this->username()})->first();
        // Check if user was successfully loaded, that the password matches
        // and active is not 1. If so, override the default error message.
        if ($user && \Hash::check($request->password, $user->password) && $user->active != 1) {
          $errors = [$this->username() => 'Your account is not active.'];
        }
        if ($request->expectsJson()) {
          return response()->json($errors, 422);
        }
        return back()->withInput($request->only($this->username(), 'remember'))
                ->withErrors($errors);
      }//fabm logout user 
      public function logout() {
        Auth::logout();  
        Session::flush();
        Cache::flush(); 
        return Redirect::to('/login'); //redirect back to login
      }//abm
/*protected function authenticated(Request $request, $user){$IPs = config('settings.IPs');session(['lieu_id' => $IPs[$_SERVER['REMOTE_ADDR']]]);
  if(isset($user->employ->service_id))session(['service' => (in_array($user->role_id,[1,3,5,6,10,11,12,13,14])) ? $user->employ->Service->id :0]);}*/
	    public function username()
      {
  		  return 'name';
      }
      public function showLoginForm()
      {
        $etab = Etablissement::first();
        return view('auth/login',compact('etab'));
      }    //fabm
}
