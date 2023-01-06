<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmins
{
 
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user(); // کاربری که لاگین کرده در حال حاضر رو برمیگردونه.
        
        if ( $user && ($user->is('admin') || $user->is('shop') ) ) {
            
            return $next($request); // همه چی اوکیه برو مرحله بعد
        }else{
            abort(403); // هلپر لاراول برای لغو همه چی
            // 403 = شما دسترسی این بخش رو ندارید.
        }
    }
}
