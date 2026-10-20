<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /** Mengarahkan pengguna ke dashboard sesuai role-nya. */
    public function index(Request $request): RedirectResponse
    {
        $route = match ($request->user()->role) {
            'admin' => 'admin.dashboard',
            'petugas' => 'petugas.dashboard',
            'customer' => 'customer.dashboard',
            default => abort(403),
        };

        return redirect()->route($route);
    }

    /** Menampilkan dashboard dengan informasi sesuai role pengguna. */
    public function show(Request $request): View
    {
        $role = $request->user()->role;

        [$roleLabel, $description] = match ($role) {
            'admin' => ['Administrator', 'Kelola akses dan pantau aktivitas portal.'],
            'petugas' => ['Petugas', 'Akses area kerja petugas layanan.'],
            'customer' => ['Customer', 'Lihat informasi dan layanan akun Anda.'],
            default => abort(403),
        };

        return view('dashboard', [
            'role' => $role,
            'roleLabel' => $roleLabel,
            'description' => $description,
        ]);
    }
}
