<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryPermitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_permits', function (Blueprint $table) {
            $table->id();
            //step 1
            $table->string('delivery_company');
            $table->date('date');
            $table->string('description');

            $table->string('resident_name');
            $table->string('resident_country');
            $table->integer('children_number');
            $table->string('aduls');
            $table->string('resident_mobile');
            $table->string('officer_country');
            $table->string('officer_number')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('trn_number')->nullable();
            $table->string('emirate_id')->nullable();
            //step 4 (Documents)
            $table->string('tenancy_contract');
            $table->date('contract_expiry');
            $table->string('passport');
            $table->date('passport_expiry');
            $table->string('title_dead');
            $table->string('emirateId_image');

            $table->json('registration_number_vehicle');

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
        Schema::dropIfExists('delivery_permits');
    }
}
