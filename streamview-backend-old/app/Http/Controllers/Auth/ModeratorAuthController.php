<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;

use App\Moderator;


class ModeratorAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:moderator', ['except' => ['logout']]);
    }

    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('moderator.auth.login');
    }

    protected function guard() {

        return \Auth::guard('moderator');

    }

    protected $registerView = 'moderator.auth.register';

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:providers',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $moderator = Moderator::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'timezone'=>$data['timezone'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'is_available' => 1,
            'is_activated' => 1
        ]);

        return $moderator;
    }

    protected function authenticated(Request $request, Moderator $moderator){

        if(\Auth::guard('moderator')->check()) {
            if($moderator = Moderator::find(\Auth::guard('moderator')->user()->id)) {
                // $moderator->is_activated == 0);
                if ($moderator->is_activated == 0) {
                    \Auth::guard('moderator')->logout();
                    return back()->with('flash_error', tr('moderator_disable'));
                }
                $moderator->timezone = $request->has('timezone') ? $request->timezone : '';
                $moderator->save();
            }   
        };
       return redirect()->route('moderator.dashboard')->with('flash_success',tr('login_success'));
    }

    public function login(Request $request) {

        // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:5'
         ]);
      
        // Attempt to log the user in
        if (\Auth::guard('moderator')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            if((\Auth::guard('moderator')->user()->is_sub_admin == YES) && (\Auth::guard('moderator')->user()->status) == DECLINED) {

                \Session::flash('flash_error', tr('sub_admin_account_decline_note'));
                
                \Auth::guard('moderator')->logout();

                return redirect()->route('moderator.login');
            }

            if((\Auth::guard('moderator')->user()->is_store == YES) && (\Auth::guard('moderator')->user()->status) == DECLINED) {

                \Session::flash('flash_error', tr('store_account_decline_note'));
                
                \Auth::guard('moderator')->logout();

                return redirect()->route('moderator.login');
            }

            // if successful, then redirect to their intended location
            return redirect()->intended(route('moderator.dashboard'))->with('flash_success',tr('login_success'));

        }
     
        // if unsuccessful, then redirect back to the login with the form data
     
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('flash_error', tr('username_password_not_match'));
    }

    public function logout() {

        \Auth::guard('moderator')->logout();
        
        return redirect()->route('moderator.login')->with('flash_success',tr('logout_success'));
    }
}
