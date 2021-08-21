<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('plate_no');
            $table->string('model')->nullable();
            $table->string('color')->nullable();
            $table->string('model_year')->nullable();
            $table->string('insurance_no')->nullable();
            $table->string('insurance_company')->nullable();
            $table->dateTime('insurance_start_date')->nullable();
            $table->dateTime('insurance_expiry_date')->nullable();
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('vehicles');
    }
}
