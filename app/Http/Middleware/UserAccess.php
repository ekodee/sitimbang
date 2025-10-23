<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        if (!$user) {
            Alert::error('Gagal', 'Silakan login terlebih dahulu.');
            return redirect()->route('login');
        }

        $userRoleName = Role::find($user->role_id)?->role_name;

        // Jika user adalah superadmin → bypass semua
        if ($userRoleName === 'superadmin') {
            return $next($request);
        }

        // Jika role user cocok dengan salah satu role yang diizinkan
        if (in_array($userRoleName, $roles)) {
            return $next($request);
        }

        // Jika tidak punya akses
        Alert::error('Gagal', 'Anda tidak memiliki akses ke halaman ini.');
        return redirect()->route('dashboard.index');
    }
}
