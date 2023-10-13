<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Product::truncate();
		// Danh sách category
		$categories = Category::get('id')->pluck('id');

		Product::factory(100)->afterCreating(function ($product) use ($categories) {
			$product->categories()->attach($categories->random());
		})->create();
	}
}
