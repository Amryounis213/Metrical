<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoveInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('move_ins', function (Blueprint $table) {
            $table->id();
            //step 1
            $table->string('full_name');
            $table->integer('country')->constrained('countries', 'id')->cascadeOnDelete();;
            $table->string('email');
            $table->string('aduls');
            $table->string('passport_number')->nullable();
            $table->string('trn_number')->nullable();
            $table->string('nationalty');
            $table->string('mobile');
            $table->string('emirate_id')->nullable();
            $table->integer('children_number')->nullable();
            //step 2
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');

            //step 3 (Emergancy Contact)

            $table->json('contact');

            //step 4 (Documents)
            $table->string('tenancy_contract')->nullable();
            $table->date('contract_expiry')->nullable();
            $table->string('passport')->nullable();
            $table->date('passport_expiry')->nullable();
            $table->string('title_dead')->nullable();
            $table->string('emirateId_image')->nullable();

            $table->json('registration_number_vehicle')->nullable();

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
        Schema::dropIfExists('move_ins');
    }
}
