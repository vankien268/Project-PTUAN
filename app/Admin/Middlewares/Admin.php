<?php

namespace App\Admin\Middlewares;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
	public function handle(Request $request, \Closure $next)
	{
		// Nếu chưa đăng nhập thì chuyển hướng về trang đăng nhập
		if (Auth::guard('admin')->guest()) {
			return redirect()->route('admin::login');
		}

		return $next($request);
	}
}
