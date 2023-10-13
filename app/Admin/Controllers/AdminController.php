<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
	/**
	 * Trang chủ admin
	 */
	public function index()
	{
		return view('admin::index');
	}
}
