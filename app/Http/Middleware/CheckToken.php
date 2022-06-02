<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->session()->get('userSession');
        if(!empty($user)){
            $response = Http::withToken($user['token'])->get('https://crowdsourcing.usf.my.id/api/admin/kategori');

            if($response->failed()){
                return redirect(('/'));
                Alert::error('Login Timeout', 'Please login again');
            }
        }else{
            return redirect(('/'));
            Alert::error('Login Timeout', 'Please login again');
        }
        
        return $next($request);
    }
}
