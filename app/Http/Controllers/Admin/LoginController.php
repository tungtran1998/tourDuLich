<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

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

    protected $redirectTo = '/admin/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function adminLogin(Request $request)
    {
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            $notification = array(
                'message' => trans('allclient.login_success'),
                'alert-type' => 'success'
            );
            return redirect()->route('dashboard')->with($notification);
        }
        $notification2 = array(
                'message' => trans('allclient.wrong'),
                'alert-type' => 'warning'
        );
        return back()->withInput($request->only('email', 'remember'))->with($notification2);
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        $notification = array(
                'message' => trans('allclient.logout_success'),
                'alert-type' => 'success'
        );
        return redirect()
            ->route('admin.loginadmin')
            ->with($notification);
    }
}