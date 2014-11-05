<?php

use Illuminate\Database\Migrations\Migration;

class CreateMesuresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mesures', function($table) {
			$table->increments('id');
			$table->integer('equip_id');
			$table->boolean('status');
			$table->boolean('d1');
			$table->boolean('d2');
			$table->boolean('d3');
			$table->boolean('d4');
			$table->boolean('d5');
			$table->string('tension');
			$table->string('current');
			$table->string('ppow');
			$table->string('spow');
			$table->string('qpow');
			$table->string('presuresuc');
			$table->string('presuredisc');
			$table->string('temp');
			$table->string('leveloil');
			$table->string('levelqmco');
			$table->string('levelgasoil');
			$table->string('fecha');
			$table->string('horasmarcha');
			$table->string('horasdeten');
			$table->string('horastotal');
			$table->string('other');
			$table->string('other1');
			$table->timestamps();
		});

		//
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()

	{
	
			Schema::drop('mesures');

		//
	}

}