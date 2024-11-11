<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $roles = Role::all();
        return view('auth.register', compact('roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

//        dd(request()->all());

        if ($request->status_user == 'Pegawai Tetap') {
            $user_code = "TCH";
        } elseif ($request->status_user == 'Paruh Waktu') {
            $user_code = "FRL";
        } else{
            $user_code = "MGG";
        }

        $user = User::create([
            'id' => Str::uuid()->toString(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_code' => strval($user_code . rand(0, 999)),
            'first_name' => $request->name,
            'last_name' => $request->name,
            'username' => $request->name,
            'status_user' => $request->status_user,
            'nip' => '',
            'is_active' => 1,
            'created_at' => Carbon::now(),
            'created_by' => null,
            'updated_at' => Carbon::now(),
            'updated_by' => null,
            'deleted_at' => null,
            'deleted_by' => null,
        ]);
        $user->assignRole($request->status_user);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
