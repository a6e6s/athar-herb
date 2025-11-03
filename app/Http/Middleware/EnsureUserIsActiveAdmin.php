<?php

namespace App\Http\Middleware;

use App\Enums\UserType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsActiveAdmin
{
    /**
     * Handle an incoming request.
     *
     * Ensures that only active users with admin-level access
     * can access the Filament admin panel.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // If user is not authenticated, let the Authenticate middleware handle it
        if (!$user) {
            return $next($request);
        }

        // Check if user is inactive
        if (!$user->is_active) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('filament.admin.auth.login')
                ->with('error', __('filament.auth.account_deactivated'));
        }

        // Check if user has admin privileges
        // Accept ADMIN, MANAGER, or SUPPORT user types
        $allowedUserTypes = [
            UserType::ADMIN,
            UserType::MANAGER,
            UserType::SUPPORT,
        ];

        if (!in_array($user->user_type, $allowedUserTypes)) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('filament.admin.auth.login')
                ->with('error', __('filament.auth.no_admin_permission'));
        }

        return $next($request);
    }
}
