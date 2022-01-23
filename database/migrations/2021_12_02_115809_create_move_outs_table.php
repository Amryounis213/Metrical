<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoveOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('move_outs', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->foreignId('country')->constrained('countries', 'id')->cascadeOnDelete();
            $table->string('email');
            $table->string('mobile');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('agree')->default(0);


            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('property_id')->constrained('properties')->cascadeOnDelete();

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
        Schema::dropIfExists('move_outs');
    }
}
