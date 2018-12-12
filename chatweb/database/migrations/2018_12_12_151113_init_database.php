<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitDatabase extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::defaultStringLength(191);
		Schema::create('rooms', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->text('picture');
			$table->integer('id_creater');
			$table->timestamps();
		});

		Schema::create('members_in_rooms', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('id_member');
			$table->integer('id_room');
			$table->timestamps();
		});

		Schema::create('messages', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('id_sender');
			$table->integer('id_room');
			$table->integer('id_mentioned_man')->nullable();
			$table->text('message');
			$table->text('images')->nullable();
			$table->text('link')->nullable();
			$table->text('file')->nullable();
			$table->text('status');
			$table->timestamps();
		});

		Schema::create('tasks', function (Blueprint $table) {
			$table->increments('id');
			$table->text('title');
			$table->text('content');
			$table->timestamp('start_date')->nullable();
			$table->integer('id_creator');
			$table->string('status');
			$table->text('id_asignees')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('rooms');
		Schema::dropIfExists('members_in_rooms');
		Schema::dropIfExists('messages');
		Schema::dropIfExists('tasks');
		Schema::dropIfExists('tasks');
	}
}
