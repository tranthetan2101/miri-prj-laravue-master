<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class UserInfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if ($request->user() && !$this->checkInfo($request->user())) {
            return $request->expectsJson()
                    ? abort(403, 'Pls update your infomation.')
                    : Redirect::route($redirectToRoute ?: 'frontend.mypage')
                    ->withErrors(['errorInfo' => 'Xin hãy cập nhật thông tin cá nhân']);
        }

        return $next($request);
    }

    public function checkInfo($user)
    {
        if (is_null($user->detail->phone_number) ||
            is_null($user->detail->addr_number) ||
            is_null($user->detail->addr_street) ||
            is_null($user->detail->city_id) ||
            is_null($user->detail->ward_id) ||
            is_null($user->detail->district_id) ||
            is_null($user->detail->birth)
        ) return false;

        return true;
    }
}
