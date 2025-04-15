<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomsTable extends Migration {

	public function up()
	{
		Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('Name_Class');
            $table->foreignId('Grade_id')->constrained('grades')->onDelete('cascade');
            $table->timestamps();
        });

	}

	public function down()
	{
		Schema::drop('Classrooms');
	}
}
