<?php

namespace App\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryProduct extends Pivot
{
	protected $table = 'category_product';
}
