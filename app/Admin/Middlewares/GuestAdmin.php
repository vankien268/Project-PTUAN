<?php

namespace App\Admin\Middlewares;

use Closure;
use Illuminate\Support\Facades\Auth;

class GuestAdmin
{
	public function handle($request, Closure $next)
	{
		// nếu người dùng đã đăng nhập thì redirect về trang quản trị
		if (Auth::guard('admin')->check()) {
			return redirect()->route('admin::index');
		}

		return $next($request);
	}
}
