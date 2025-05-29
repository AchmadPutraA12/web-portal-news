<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.auth.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)
            ->orWhere('username', $request->email)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            if ($user->is_active == 0) {
                return redirect()->back()->with('error', 'Akun Anda telah dinonaktifkan.');
            }

            Auth::login($user);

            $request->session()->regenerate();

            switch ($user->role) {
                case 'admin':
                    return redirect()->intended(route('admin.user.index'))->with('success', 'Login Berhasil');
                case 'penulis':
                    return redirect()->intended(route('admin.article.index'))->with('success', 'Login Berhasil');
                default:
                    Auth::logout();
                    return redirect()->back()->with('errors', 'Akun Anda tidak memiliki akses.');
            }
        }

        return back()->with('errors', 'Email atau password salah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
