<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
			$table->id();
			$table->string('name')->comment('Tên danh mục');
			$table->string('slug')->unique();
			$table->string('meta_title')->nullable();
			$table->text('meta_description')->nullable();
			$table->tinyInteger('level')->default(1);
			$table->unsignedBigInteger('parent_id')->default(0);
			$table->timestamps();
			$table->softDeletes()->comment('Xoá mềm');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
