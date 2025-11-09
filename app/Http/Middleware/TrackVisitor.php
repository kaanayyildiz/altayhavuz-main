<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Admin paneli isteklerini takip etme (hem URL hem de session kontrolü)
        $isAdminRequest = $request->is('admin/*') || $request->is('admin');
        $isAdminLoggedIn = session()->get('admin_logged_in', false);
        
        if (!$isAdminRequest && !$isAdminLoggedIn) {
            try {
                Visitor::create([
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'url' => $request->fullUrl(),
                    'referer' => $request->header('referer'),
                    'visited_at' => now()->toDateString(),
                ]);
            } catch (\Exception $e) {
                // Hata durumunda sessizce devam et
            }
        }

        return $next($request);
    }
}
