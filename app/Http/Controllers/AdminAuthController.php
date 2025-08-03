<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLogin()
    {
        // Jika admin sudah login, redirect ke dashboard
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.auth.login');
    }

    /**
     * Handle admin login request.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang, ' . Auth::guard('admin')->user()->name . '!');
        }

        return back()->withErrors([
            'email' => 'Email atau password tidak sesuai.',
        ])->withInput($request->except('password'));
    }

    /**
     * Show the admin registration form.
     */
    public function showRegister()
    {
        return view('admin.auth.register');
    }

    /**
     * Handle admin registration request.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $adminData = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];

            // Tambahkan field opsional jika kolom ada
            try {
                if (Schema::hasColumn('admins', 'role')) {
                    $adminData['role'] = 'admin';
                }
                if (Schema::hasColumn('admins', 'is_active')) {
                    $adminData['is_active'] = true;
                }
            } catch (\Exception $e) {
                // Ignore schema check errors
            }

            $admin = Admin::create($adminData);

            // Auto login after registration
            Auth::guard('admin')->login($admin);

            return redirect()->route('admin.dashboard')
                ->with('success', 'Registrasi berhasil! Selamat datang, ' . $admin->name . '!');

        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Terjadi kesalahan saat registrasi: ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Handle admin logout request.
     */
    public function logout(Request $request)
    {
        $adminName = Auth::guard('admin')->user()->name;
        
        Auth::guard('admin')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Logout berhasil. Sampai jumpa, ' . $adminName . '!');
    }

    /**
     * Show admin dashboard.
     */
    public function dashboard()
    {
        // Pastikan admin sudah login
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        $admin = Auth::guard('admin')->user();
        
        // Data statistik untuk dashboard dengan error handling
        try {
            $totalUsers = \App\Models\User::count();
            
            // Cek apakah kolom is_active ada di tabel users
            $activeUsers = 0;
            try {
                $activeUsers = \App\Models\User::where('is_active', true)->count();
            } catch (\Exception $e) {
                // Jika kolom is_active tidak ada, ambil semua user
                $activeUsers = $totalUsers;
            }
            
            $stats = [
                'total_users' => $totalUsers,
                'active_users' => $activeUsers,
                'total_admins' => Admin::count(),
                'total_applications' => 0, // Sesuaikan dengan model aplikasi jika ada
            ];
        } catch (\Exception $e) {
            // Fallback jika ada error
            $stats = [
                'total_users' => 0,
                'active_users' => 0,
                'total_admins' => Admin::count(),
                'total_applications' => 0,
            ];
        }

        return view('admin.dashboard', compact('admin', 'stats'));
    }

    /**
     * Show admin profile.
     */
    public function profile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    /**
     * Update admin profile.
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan admin lain',
            'new_password.min' => 'Password baru minimal 6 karakter',
            'new_password.confirmed' => 'Konfirmasi password baru tidak sesuai',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Update basic info menggunakan model update
            $updateData = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            // Update password if provided
            if ($request->filled('new_password')) {
                if (!$request->filled('current_password') || 
                    !Hash::check($request->current_password, $admin->password)) {
                    return back()->withErrors([
                        'current_password' => 'Password saat ini tidak sesuai'
                    ])->withInput();
                }
                
                $updateData['password'] = Hash::make($request->new_password);
            }

            // Update menggunakan Admin model
            Admin::where('id', $admin->id)->update($updateData);

            return back()->with('success', 'Profile berhasil diperbarui!');

        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Terjadi kesalahan saat memperbarui profile: ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Check if admin is authenticated.
     */
    public function checkAuth()
    {
        return response()->json([
            'authenticated' => Auth::guard('admin')->check(),
            'admin' => Auth::guard('admin')->user()
        ]);
    }
}