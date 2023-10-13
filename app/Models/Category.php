<?php

namespace App\Models;

use App\Pivots\CategoryProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $fillable = [
		'name',
		'slug',
		'level',
		'parent_id',
		'meta_title',
		'meta_description',
	];

	/**===============================================
	 * ===================SCOPED======================
	 * ===============================================
	 * cú pháp scope{tên scope viết hoa chữ đầu}
	 */
	public function scopeGetParent($query, array $level = [1])
	{
		return $query->whereIn('level', $level);
	}

	/**===============================================
	 * =============RELATIONSHIP======================
	 * ===============================================
	 */
	/**
	 * Danh sách sản phẩm
	 * n - n
	 */
	public function products()
	{
		return $this->belongsToMany(Product::class)->using(CategoryProduct::class);
	}

	/**
	 * Danh mục cha
	 * 1 - n
	 */
	public function parent()
	{
		return $this->belongsTo(Category::class, 'parent_id');
	}

	/**
	 * Danh sách danh mục con
	 * 1 - n
	 */
	public function children()
	{
		return $this->hasMany(Category::class, 'parent_id');
	}
}
