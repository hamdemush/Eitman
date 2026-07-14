<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user()) {
            return response()->json([
                'success' => false,
                'message' => 'غير مصرح بالدخول، يرجى تسجيل الدخول أولاً.'
            ], 401);
        }

        $userRole = $request->user()->role; 

        if (($role === 'doctor' || $role === 'psychologist') && 
            ($userRole === 'doctor' || $userRole === 'psychologist')) {
            $role = $userRole; 
        }

        if ($userRole !== $role) {
            return response()->json([
                'success' => false,
                'message' => 'عذراً، لا تمتلك الصلاحيات الكافية للوصول إلى هذا الإجراء.'
            ], 403);
        }

        return $next($request);
    }
}