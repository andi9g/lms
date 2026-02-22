<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GerbangStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $status = auth()->user()->posisi->status;
        if($status===1) {
            return $next($request);
        }else {
            return redirect('dashboard')->with('warning', [
                'title' => 'Warning!',
                'text'  => 'Menunggu admin melakukan verifikasi akun',
                'icon'  => 'warning',
            ]);
        }
    }
}
