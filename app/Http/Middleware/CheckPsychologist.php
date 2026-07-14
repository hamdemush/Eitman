<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPsychologist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure$next): Response
    {
        if (!$request->user() || $request->user()->role !== 'psychologist') {
            return response()->json([
                'success' => false,
                'message' => 'عذراً، هذا الإجراء مخصص للأطباء النفسيين فقط.'
            ], 403);
        }

        return $next($request);
    }
}