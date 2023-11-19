<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required', 'string', 'min:4', 'confirmed',
            'role' => 'required|in:user,admin',  
        ]);

        $user   =   User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Fetch the role directly from the request
        $role_id = $request->input('role') == 'user' ? 1 : 2;

        DB::table('role_user')->insert(['role_id' => $role_id,'user_id' => $user->id]);

        
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard'); // Redirect admins to admin dashboard
        }

        return redirect()->route('user.dashboard'); // Redirect users to user dashboard or homepage;
    }
}
