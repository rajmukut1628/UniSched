<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Page
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }


    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'string',
                'email:rfc',
                'max:255',
            ],

            'password' => [
                'required',
                'string',
            ],
        ], [
            'email.required' =>
                'Please enter your admin email address.',

            'email.email' =>
                'Please enter a valid email address.',

            'password.required' =>
                'Please enter your password.',
        ]);

        $email = Str::lower(
            trim($credentials['email'])
        );

        $throttleKey =
            $email . '|' . $request->ip();

        if (
            RateLimiter::tooManyAttempts(
                $throttleKey,
                5
            )
        ) {
            $seconds =
                RateLimiter::availableIn(
                    $throttleKey
                );

            throw ValidationException::withMessages([
                'email' =>
                    "Too many login attempts. Please try again in {$seconds} seconds.",
            ]);
        }

        $admin = User::whereRaw(
            'LOWER(email) = ?',
            [$email]
        )->first();

        if (!$admin) {

            RateLimiter::hit(
                $throttleKey,
                60
            );

            throw ValidationException::withMessages([
                'email' =>
                    'This email is not registered as an administrator.',
            ]);
        }

        if (
            !Auth::attempt(
                [
                    'email' => $admin->email,
                    'password' => $credentials['password'],
                ],
                $request->boolean('remember')
            )
        ) {
            RateLimiter::hit(
                $throttleKey,
                60
            );

            throw ValidationException::withMessages([
                'password' =>
                    'The password you entered is incorrect.',
            ]);
        }

        RateLimiter::clear(
            $throttleKey
        );

        $request
            ->session()
            ->regenerate();

        return redirect()
            ->intended(
                route('admin.dashboard')
            )
            ->with(
                'success',
                'Welcome back, ' .
                Auth::user()->name .
                '.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Forgot Password Page
    |--------------------------------------------------------------------------
    */

    public function showForgotPassword()
    {
        return view(
            'admin.auth.forgot-password'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Send Reset Link
    |--------------------------------------------------------------------------
    */

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email:rfc',
                'max:255',
            ],
        ]);

        $email = Str::lower(
            trim($request->email)
        );

        /*
        |--------------------------------------------------------------------------
        | Only Registered Admin Email
        |--------------------------------------------------------------------------
        */

        $admin = User::whereRaw(
            'LOWER(email) = ?',
            [$email]
        )->first();

        if (!$admin) {
            throw ValidationException::withMessages([
                'email' =>
                    'This email is not registered as an administrator.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Laravel Password Broker
        |--------------------------------------------------------------------------
        */

        $status = Password::sendResetLink([
            'email' => $admin->email,
        ]);

        if (
            $status === Password::RESET_LINK_SENT
        ) {
            return back()->with(
                'status',
                __($status)
            );
        }

        throw ValidationException::withMessages([
            'email' => __($status),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Reset Password Page
    |--------------------------------------------------------------------------
    */

    public function showResetPassword(
        Request $request,
        string $token
    ) {
        return view(
            'admin.auth.reset-password',
            [
                'token' => $token,
                'email' => $request->query('email'),
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Reset Password
    |--------------------------------------------------------------------------
    */

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => [
                'required',
            ],

            'email' => [
                'required',
                'email:rfc',
            ],

            'password' => [
                'required',
                'confirmed',
                PasswordRule::min(8)
                    ->letters()
                    ->numbers(),
            ],
        ], [
            'password.confirmed' =>
                'Password confirmation does not match.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Prevent Password Reset for Unknown Email
        |--------------------------------------------------------------------------
        */

        $admin = User::whereRaw(
            'LOWER(email) = ?',
            [
                Str::lower(
                    trim($request->email)
                ),
            ]
        )->first();

        if (!$admin) {
            throw ValidationException::withMessages([
                'email' =>
                    'This email is not registered as an administrator.',
            ]);
        }

        $status = Password::reset(
            [
                'email' => $admin->email,
                'password' => $request->password,
                'password_confirmation' =>
                    $request->password_confirmation,
                'token' => $request->token,
            ],

            function ($user, $password) {

                $user->forceFill([
                    'password' => $password,
                ])->save();
            }
        );

        if (
            $status === Password::PASSWORD_RESET
        ) {
            return redirect()
                ->route('admin.login')
                ->with(
                    'success',
                    'Your password has been reset successfully. You can now sign in.'
                );
        }

        throw ValidationException::withMessages([
            'email' => __($status),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request
            ->session()
            ->invalidate();

        $request
            ->session()
            ->regenerateToken();

        return redirect()
            ->route('admin.login')
            ->with(
                'success',
                'You have been logged out successfully.'
            );
    }
    public function showResetPasswordForm(
    \Illuminate\Http\Request $request,
    string $token
) {
    return view('admin.auth.reset-password', [
        'token' => $token,
        'email' => $request->query('email'),
    ]);
}
}