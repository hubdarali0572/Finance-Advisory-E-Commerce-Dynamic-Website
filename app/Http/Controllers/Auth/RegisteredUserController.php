<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     event(new Registered($user));

    //     Auth::login($user);

    //     return redirect(route('dashboard', absolute: false));
    // }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'login'    => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $login = $request->login;

        $isEmail = filter_var($login, FILTER_VALIDATE_EMAIL);

        // Optional phone validation (Pakistan)
        if (! $isEmail && ! preg_match('/^03[0-9]{9}$/', $login)) {
            return back()->withErrors([
                'login' => 'Please enter a valid email or phone number.',
            ])->withInput();
        }

        // Prevent duplicate email / phone
        if ($isEmail && User::where('email', $login)->exists()) {
            return back()->withErrors(['login' => 'Email already exists.'])->withInput();
        }

        if (! $isEmail && User::where('phone', $login)->exists()) {
            return back()->withErrors(['login' => 'Phone number already exists.'])->withInput();
        }
        // Step 1: Create the user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $isEmail ? $request->login : null,
            'phone'    => $isEmail ? null : $request->login,
            'status'   => 'active',
            'password' => Hash::make($request->password),
        ]);

        // Step 2: Ensure 'User' role exists
        $role = Role::firstOrCreate(['name' => 'User', 'guard_name' => 'web']);

        // Step 3: Assign role using Spatie
        $user->assignRole($role->name);

        // Step 4: Save role_id in users table
        $user->role_id = $role->id;
        $user->save();


        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard.index');
    }
}
