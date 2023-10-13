<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
	protected $categories;

	public function __construct($count = null, ?Collection $states = null, ?Collection $has = null, ?Collection $for = null, ?Collection $afterMaking = null, ?Collection $afterCreating = null, $connection = null)
	{
		parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection);
		$this->categories = Category::get();
	}

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		$faker = $this->faker;
		$name = $faker->name;
		$categoryId = $this->categories->pluck('id')->random();
		return [
			'name' => $name,
			'slug' => Str::slug($name),// Tên sản phẩm -> ten-san-pham
			'meta_title' => $faker->text(20),
			'meta_description' => $faker->text(500),
			'description' => $faker->text(1000),
			'price' => $faker->numberBetween(100000000, 10000000000),
			'category_1' => rand(1, 4),
			'category_2' => $categoryId
		];
	}
}
