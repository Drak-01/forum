<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    /**
     * Affiche le formulaire de connexion
     */
    public function index()
    {
        return view('auth.forms.login');
    }

    public function check(Request $request)
    {
        // 1. Validation
        $request->validate([
            'univEmail' => 'required|email',
            'password' => 'required'
        ]);
    
        // 2. Tentative de connexion
        if (!Auth::attempt(['univEmail' => $request->univEmail, 'password' => $request->password])) {
            return back()->withErrors(['univEmail' => 'Identifiants incorrects']);
        }
    
        // 3. Récupération de la route intended
        $intendedRoute = $request->intended ?? session('intended');
        // dd( $request->intended);
        // 4. Redirection
        if ($intendedRoute && Route::has($intendedRoute)) {
            return redirect()->route($intendedRoute);
        }
        return redirect()->route('user.questions.index'); // Redirection par défaut
    }

    /**
     * Déconnecte l'utilisateur
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.index');
    }

    /**
     * Vérifie que le taux de tentatives n'est pas dépassé
     */
    protected function ensureIsNotRateLimited(Request $request): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'univEmail' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Génère la clé pour le rate limiting
     */
    protected function throttleKey(Request $request): string
    {
        return Str::transliterate(Str::lower($request->input('univEmail')) . '|' . $request->ip());
    }
}
