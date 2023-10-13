<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryHistoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventory_history', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('inventory_id');
			$table->dateTime('datetime')->default(now());
			$table->string('type')->default(\App\Models\InventoryHistory::IMPORT);
			$table->string('amount')->default(1);
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
		Schema::dropIfExists('inventory_history');
	}
}
