<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    public function registerForm()
    {
        return view('users.register');
    }

    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'name' => 'required',
        ]);
    
        // Buat pengguna baru
        $user = User::create([
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']), // Menggunakan bcrypt untuk meng-hash password
            'name' => $validatedData['name'],
        ]);
    
        // Redirect ke halaman login atau halaman beranda setelah pendaftaran sukses
        return redirect('/login')->with('success', 'Registration successful. Please log in.');
    }

    /**
     * Show the login form.
     */
    public function loginForm()
    {
        return view('users.login');
    }

    /**
     * Handle user login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Cari pengguna dengan email yang cocok
        $user = User::where('email', $credentials['email'])->first();

        // Jika pengguna ditemukan dan password cocok
        if ($user && password_verify($credentials['password'], $user->password)) {
            // Set session untuk pengguna
            $request->session()->put('user', $user);
            return redirect()->intended('/expenses'); // Arahkan ke halaman indeks
        }

        return back()->withErrors(['login' => 'Invalid username or password.']);
    }  
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Temukan pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Tampilkan view dengan formulir edit
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update user.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        // Validasi data input
        $validatedData = $request->validate([
            'email' => 'required|unique:users,email,' . $user->id,
            'name' => 'required',
        ]);
    
        // Update informasi pengguna
        $user->update([
            'email' => $validatedData['email'],
            'name' => $validatedData['name'],
        ]);
    
        // Redirect kembali ke halaman profil pengguna dengan pesan sukses
        return redirect()->route('Users.index')->with('success', 'Profile updated successfully');
    }

    /**
     * Menampilkan informasi detail pengguna berdasarkan ID.
     */
    public function get($id)
    {
        // Temukan pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Tampilkan view dengan informasi pengguna
        return view('users.get', ['user' => $user]);
    }
    
    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        // Hapus session pengguna
        $request->session()->forget('user');

        // Redirect kembali ke halaman user
        return redirect('/register')->with('success', 'Logout successful.');
    }    
}
