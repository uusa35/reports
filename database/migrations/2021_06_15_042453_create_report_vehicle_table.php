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
            $table->string('injury_name')->nullable();
            $table->string('injury_civil_id')->nullable();
            $table->string('image')->nullable()->default('default.svg');
            $table->string('path')->nullable();
            $table->boolean('injured')->default(0);
            $table->string('driver_license')->nullable()->default('default.svg');
            $table->string('notes')->nullable();
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
