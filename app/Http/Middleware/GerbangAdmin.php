<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class GerbangAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin = auth()->user()->posisi->posisi;
        if($admin == "admin") {
            return $next($request);
        }else {
            
            return redirect('dashboard')->with('warning', [
                'title' => 'Warning!',
                'text'  => 'Maaf anda bukan admin',
                'icon'  => 'warning',
            ]);
        }
    }
}
