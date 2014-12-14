<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) 
		{
			$table->increments('id');
			$table->string('first_name', 16);
			$table->string('last_name', 16);
			$table->string('username', 32);
			$table->string('email');
			$table->string('gender');
			$table->string('birthday');
			$table->string('password', 60);
			$table->string('remember_token', 100)->nullable();
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
		Schema::drop('users');
	}

}
