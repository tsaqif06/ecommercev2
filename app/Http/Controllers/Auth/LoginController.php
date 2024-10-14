<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite;
use App\User;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Override redirectTo property
    protected function redirectTo()
    {
        $role = auth()->user()->role;

        switch ($role) {
            case 'admin':
            case 'manager':
                return '/admin';
            default:
                return '/home';
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Override the credentials method
    protected function credentials(Request $request)
    {
        return [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'active',
        ];
    }

    // Override the attemptLogin method
    protected function attemptLogin(Request $request)
    {
        // Try to login with 'admin' role
        $credentials = $this->credentials($request);
        $credentials['role'] = 'admin';

        if ($this->guard()->attempt($credentials, $request->filled('remember'))) {
            return true;
        }

        // Try to login with 'manager' role
        $credentials['role'] = 'manager';
        return $this->guard()->attempt($credentials, $request->filled('remember'));
    }

    // Socialite functions
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $userSocial = Socialite::driver($provider)->stateless()->user();
        $users = User::where(['email' => $userSocial->getEmail()])->first();

        if ($users) {
            Auth::login($users);
            return redirect('/')->with('success', 'You are login from ' . $provider);
        } else {
            $user = User::create([
                'name' => $userSocial->getName(),
                'email' => $userSocial->getEmail(),
                'image' => $userSocial->getAvatar(),
                'provider_id' => $userSocial->getId(),
                'provider' => $provider,
            ]);
            return redirect()->route('home');
        }
    }
}
