<?php

namespace App\Traits;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasAvatar
{
	/**
	 * Tạo thuộc tính có thên avatar
	 */
	public function getAvatarAttribute(): string
	{
		return $this->avatar_path ? $this->getAvatar() : $this->avatarDefault();
	}

	public function getAvatar()
	{
		return Storage::disk('public')->url($this->avatar_path);
	}

	/**
	 * Avatar mặc định
	 */
	public function avatarDefault(): string
	{
		return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
	}

	/**
	 * Cập nhật ảnh đại diện
	 */
	public function updateAvatar(UploadedFile $avatar = null)
	{
		if (!$avatar) {
			return false;
		}
		switch ($this) {
			// Nếu file hiện tại là user
			case $this instanceof User:
				$folder = '/users';
				break;
			// Nếu là sản phẩm
			case $this instanceof Product:
				$folder = '/products';
				break;
			default;
				$folder = '/others';
		}

		tap($avatar->storePublicly($folder, ['disk' => 'public']), function ($path) {
			$this->avatar_path = $path;
			$this->save();
		});
	}
}
