<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_vehicle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained();
            $table->foreignId('report_id')->constrained();
            $table->string('traffic_offenses')->nullable();
            $table->string('injury_civil_id')->nullable();
            $table->string('image')->nullable()->default('default.svg');
            $table->string('path')->nullable();
            $table->string('traffic_offences')->nullable();
            $table->string('injury_civil_id_1')->nullable();
            $table->string('injury_name_1')->nullable();
            $table->string('injured_1')->nullable();
            $table->string('injury_civil_id_2')->nullable();
            $table->string('injury_name_2')->nullable();
            $table->string('injured_2')->nullable();
            $table->string('injury_civil_id_3')->nullable();
            $table->string('injury_name_3')->nullable();
            $table->string('injured_3')->nullable();
            $table->string('driver_license')->nullable();
            $table->string('description')->nullable();
            $table->string('notes')->nullable();
            $table->string('building_no')->nullable();
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
        Schema::dropIfExists('report_vehicle');
    }
}
