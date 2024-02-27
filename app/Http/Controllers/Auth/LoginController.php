<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        $this->isUserActive();

        if ($response = $this->authenticated($request, $this->guard()->user()))
        {
            return $response;
        }

        if (!isset($request->remember))
        {
            return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath())
                ->withCookie(Cookie::forget('email'))
                ->withCookie(Cookie::forget('password'))
                ->withCookie(Cookie::forget('remember'));
        }

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath())
            ->withCookie(Cookie::make('email', $request->email, 3600))
            ->withCookie(Cookie::make('password', $request->password, 3600))
            ->withCookie(Cookie::make('remember', 1, 3600));
    }

    public function isUserActive()
    {
        if (Auth::check())
        {
            if (User::SHOULD_VERIFY)
            {
                $column = User::VERIFY_COLUMN;

                if (isset(auth()->user()->$column) ? auth()->user()->$column == 'inactive' : false)
                {
                    auth()->logout();
                    showNotyf('Please verify your email.', 'error');

                    return redirect('login');
                }
            }
        }

        return;
    }
}
