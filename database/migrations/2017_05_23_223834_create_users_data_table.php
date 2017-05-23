<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDataTable extends Migration
{
	public function up() {
		Schema::create( 'users_data', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->string( 'name' );
			$table->timestamp( 'timestamp' );
			$table->string( 'action_text' );
			$table->string( 'action' );
			$table->string( 'profile_picture_url' );
		} );
	}

	public function down() {
		Schema::drop( 'users_data' );
	}
}
