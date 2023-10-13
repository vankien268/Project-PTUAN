<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

	/**
	 * Trang cá nhân
	 */
	public function profile()
	{
		$pageName = __('Trang cá nhân');
		$view = compact('pageName');
		return view('admin::auth.profile')->with($view);
	}

	/**
	 * Lưu lại trang cá nhân
	 */
	public function saveProfile(Request $request)
	{
		$id = Auth::guard('admin')->id();

		// validation
		$validator = Validator::make($request->all(), [
			'avatar_path' => 'nullable|image|mimes:jpg,gif,jpeg,png|max:2048',// 2mb
			'name' => 'required|string|max:255',
			'username' => 'required|string|alpha_dash|max:50|unique:users,username,' . $id,
			'email' => 'required|string|email|unique:users,email,' . $id,
			'mobile' => 'nullable|string|digits:10|starts_with:0|unique:users,mobile,' . $id,
		]);

		if ($validator->fails()) {
			return $this->response($validator->errors(), 422, $validator->errors()->first());
		}

		$user = User::findOrFail($id);
		$user->update([
			'name' => $request->get('name'),
			'username' => $request->get('username'),
			'email' => $request->get('email'),
			'mobile' => $request->get('mobile')
		]);

		$user->updateAvatar($request->file('avatar_path'));

		return $this->response(null, 200, __('Cập nhật trang cá nhân thành công'));
	}


	/**================================================================
	 * Trả về giáo diện đăng nhập
	 */
	public function showFormLogin()
	{
		return view('admin::auth.login');
	}

	/**
	 * Xử lý đăng nhập
	 */
	public function login(Request $request)
	{
		// validation
		$validator = Validator::make($request->all(), [
			'username' => 'required|string',
			'password' => 'required|string',
		], [], [
			'username' => __('Tài khoản'),
			'password' => __('Mật khẩu'),
		]);

		// nếu chưa đúng format
		if ($validator->fails()) {
			return $this->response($validator->errors(), 422);
		}

		$login = Auth::guard('admin')->attempt([
			'username' => $request->get('username'),
			'password' => $request->get('password'),
		], $request->get('remember'));

		// Đã đăng nhập thành công
		if ($login) {
			return $this->response(null, 200, __('Đăng nhập thành công'));
		}
		return $this->response(null, 401, __('Sai tài khoản hoặc mật khẩu'));
	}
}
