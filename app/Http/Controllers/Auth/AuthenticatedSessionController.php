<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use Illuminate\View\View;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        // Validate and get the input
        $validated = $request->validated();
        $email = $validated['email'];
        $password = $validated['password'];
        $accountType = $validated['accountType'];

        if ($accountType === 'company') {
            $company = Company::where('email', $email)->first();

            if (!$company) {
                return back()->withErrors(['email' => 'البريد الإلكتروني او الباسورد غير صحيحه'])->withInput();
            }


            if (!$company->isAccepted) {
                return back()->withErrors(['accountType' => 'الحساب غير مقبول بعد'])->withInput();
            }

            Auth::guard('company')->login($company);

            $request->session()->regenerate();
            return redirect()->route('company.dashboard');

        }

        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME)->with('user',auth()->user());
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
