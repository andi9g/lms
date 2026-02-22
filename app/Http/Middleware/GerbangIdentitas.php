<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GerbangIdentitas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $detail = auth()->user()->detailuser?1:0;
        $admin = auth()->user()->posisi->posisi;
        if($detail === 0 && $admin != "admin") {
            
            return redirect('profil')->with('warning', [
                'title' => 'warning!',
                'text'  => 'Silahkan lengkapi identitas!',
                'icon'  => 'warning',
            ]);
        }else {
            return $next($request);
        }
    }
}
