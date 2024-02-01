<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\LoginDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|max:255',
        ]);

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if ($user && $user->status !== 1) {
            return redirect()->route('login')->with('message', 'User Suspended');
        }

        if (Auth::attempt($credentials)) {
            $user->update([
                'last_login_ip' => $request->ip(),
                'last_login_date' => now(),
            ]);

            LoginDetail::create([
                'user_id' => $user->id,
                'login_ip' => $request->ip(),
            ]);

            return redirect()->route('home');
        } else {
            return redirect()->route('login')->with('fail', 'Incorrect Credentials');
        }
    }

}
