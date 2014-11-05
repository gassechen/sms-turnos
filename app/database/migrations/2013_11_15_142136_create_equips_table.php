<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEquipsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equips', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('tipo');
			$table->string('marcamotor');
			$table->string('marcagencom');
			$table->string('potencia');
			$table->string('numeroequipo');
			$table->string('tipobba');
			$table->string('qh');
			$table->string('capacidad');
			$table->string('productotipo');
			$table->string('numpozo');
			$table->text('varios');
			$table->string('ubicacion');
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
		Schema::drop('equips');
	}

}
