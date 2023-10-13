<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('slug')->unique();
			$table->string('meta_title')->nullable();
			$table->text('meta_description')->nullable();
			$table->longText('description');
			$table->unsignedBigInteger('price');
			$table->unsignedBigInteger('category_id');// Danh mục cha có thể là category level 2,3
			$table->unsignedBigInteger('category_1')->comment('id danh mục level 1 ');
			$table->unsignedBigInteger('category_2')->comment('id danh mục level 2 ');
			$table->unsignedBigInteger('category_3')->nullable()->comment('id danh mục level 3 ');
			$table->unsignedBigInteger('brand_id')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('products');
	}
}
