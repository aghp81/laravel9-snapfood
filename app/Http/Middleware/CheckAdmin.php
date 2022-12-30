<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
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
        $user = auth()->user(); // کاربری که لاگین کرده در حال حاضر رو برمیگردونه.
        
        if ( $user && $user->role  == 'admin' ) {
            
            return $next($request); // همه چی اوکیه برو مرحله بعد
        }else{
            abort(403); // هلپر لاراول برای لغو همه چی
            // 403 = شما دسترسی این بخش رو ندارید.
        }
    }
}
