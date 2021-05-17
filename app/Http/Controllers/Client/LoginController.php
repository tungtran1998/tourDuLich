<?php

namespace App\Http\Controllers\Client;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Laravel\Passport\TokenRepository;
use Session;
use Socialite;
use Exception;
use App\Models\User;
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

    protected $redirectTo = '/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }

    public function guard()
    {
        return Auth::guard('web');
    }
    
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();
           

            if($finduser){
                if ($finduser->status == 0) {
                       Auth::login($finduser);
                       return redirect('/');
                }else {

                    return redirect()->rote('client.login');
                }

            }else{
                $newUser = User::create([
                    'username' => $user->name,
                    'email' => $user->email,
                    'email_verified_at'=> now(),
                    'status' => 0,
                    'google_id'=> $user->id,

                ]);
                Auth::login($newUser);

                return redirect('/');
            }

        } catch (Exception $e) {
            return redirect('auth/google');
        }
    }
    public function showLoginForm()
    {
        return view('client.auth.login');
    }

    public function clientLogin(Request $request)
    {

        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
            
        ]);

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 0], $request->get('remember'))) {
            $notification = array(
            'message' => trans('allclient.login_success'),
            'alert-type' => 'success'
            );
            return redirect()->intended('/')->with($notification);
        }
        $notification2 = array(
            'message' => trans('allclient.wrong'),
            'alert-type' => 'warning'
        );
        return back()->withInput($request->only('email', 'remember'))->with($notification2);
    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        $notification = array(
            'message' => trans('allclient.logout_success'),
            'alert-type' => 'success'
        );
        return redirect()
            ->route('client.login')
            ->with($notification);
    }

}
