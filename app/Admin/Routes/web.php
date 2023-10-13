<?php

use App\Admin\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// route('admin::index');
Route::middleware(['web'])->prefix('admin')->name('admin::')->group(function () {
	// Phần người chưa đăng nhập
	Route::middleware('guestAdmin')->group(function () {
		Route::get('login', [\App\Admin\Controllers\AuthController::class, 'showFormLogin'])->name('login');
		Route::post('login', [\App\Admin\Controllers\AuthController::class, 'login'])->name('login');
	});


	/**=============================================================================
	 * ================Người dùng đã đăng nhập và là admin==========================
	 * =============================================================================
	 */
	Route::middleware('admin')->group(function () {
		Route::get('/', [\App\Admin\Controllers\AdminController::class, 'index'])->name('index');
		/**
		 * Quản lý danh mục
		 */
		Route::prefix('category')->name('category.')->group(function () {
			// Danh sách
			Route::get('/', [CategoryController::class, 'index'])->name('index');
			// sửa
			Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
			Route::put('update/{id}', [CategoryController::class, 'update'])->name('update');
			// Xóa
			Route::delete('destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
			// Thêm
			Route::get('create', [CategoryController::class, 'create'])->name('create');
			Route::post('store', [CategoryController::class, 'store'])->name('store');
			// Thùng rác
			Route::get('trash', [CategoryController::class, 'trash'])->name('trash');
			// Khôi phục danh mục bị xóa
			Route::put('restore/{id}', [CategoryController::class, 'restore'])->name('restore');
			// xem chi tiết
			Route::get('{id}', [CategoryController::class, 'show'])->name('show');
		});

		/**
		 * Trang cá nhân
		 */
		Route::prefix('auth')->name('auth.')->group(function () {
			Route::get('/', [\App\Admin\Controllers\AuthController::class, 'profile'])->name('profile');
			Route::put('save-profile', [\App\Admin\Controllers\AuthController::class, 'saveProfile'])->name('profile');
		});
	});
});
