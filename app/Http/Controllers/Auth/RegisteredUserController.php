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

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->role = $request->role;
        $user->alamat = $request->alamat;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($user->role == 'pengelola') {
            $user->is_aktif = 0;
            $user->penanggung_jawab = $request->penanggung_jawab;
        } else if ($user->role == 'pengunjung') {
            $user->is_aktif = 1;
            $user->instansi = $request->instansi;
            $user->asal = $request->asal;
            $user->status_pengunjung = $request->status_pengunjung;
        }

        $user->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
