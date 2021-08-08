<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('hot_line')->nullable();
            $table->string('notes')->nullable();
            $table->string('description')->nullable();
            $table->boolean('injuries')->default(1);
            $table->boolean('is_traffic')->default(0);
            $table->boolean('is_ambulance')->default(0);
            $table->boolean('is_fire')->default(0);
            $table->boolean('is_damage')->default(0);
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('report_types');
    }
}
