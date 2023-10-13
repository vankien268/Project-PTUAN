<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use HasFactory;

	/**
	 * Danh sách danh mục sản phẩm thuộc về
	 */
	public function categories()
	{
		return $this->belongsToMany(Category::class, 'category_product');
	}
}
