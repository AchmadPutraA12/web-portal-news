<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\Admin\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login(Request $request)
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
                    return redirect()->intended(route('admin.index'))->with('success', 'Login Berhasil');
                case 'penulis':
                    return redirect()->intended(route('kasir.index'))->with('success', 'Login Berhasil');
                default:
                    Auth::logout();
                    return redirect()->back()->with('errors', 'Akun Anda tidak memiliki akses.');
            }
        }

        return back()->with('errors', 'Email atau password salah.');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::all();
            return UserDataTable::make($users);
        }

        return view('pages.admin.user.index', [
            'title' => 'Data User',
        ]);
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
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:100|unique:users',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role'     => 'required|string',
            'jk'       => ['required', Rule::in(['L', 'P'])],
            'phone'    => 'required|string|max:20',
            'is_active' => 'nullable|boolean',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'username' => $validated['username'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
            'jk'       => $validated['jk'],
            'phone'    => $validated['phone'],
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'User berhasil ditambahkan.',
            'data'    => $user
        ]);
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
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => ['required', 'string', 'max:100', Rule::unique('users')->ignore($user->id)],
            'email'    => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:6',
            'role'     => 'required|string',
            'jk'       => ['required', Rule::in(['L', 'P'])],
            'phone'    => 'required|string|max:20',
            'is_active' => 'nullable|boolean',
        ]);

        $user->name     = $validated['name'];
        $user->username = $validated['username'];
        $user->email    = $validated['email'];
        $user->role     = $validated['role'];
        $user->jk       = $validated['jk'];
        $user->phone    = $validated['phone'];
        $user->is_active = $request->has('is_active') ? 1 : 0;

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'User berhasil diperbarui.',
            'data'    => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil dihapus.'
        ]);
    }
}
