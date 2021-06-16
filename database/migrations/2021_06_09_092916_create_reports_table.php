<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('reference_id');
            $table->boolean('has_injuries')->default(0);
            $table->integer('injuries_no')->nullable();
            $table->string('street')->nullable();
            $table->string('building_no')->nullable();
            $table->string('area')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->string('image_two')->nullable();
            $table->string('image_three')->nullable();
            $table->string('image_four')->nullable();
            $table->string('video_one')->nullable();
            $table->string('video_two')->nullable();
            $table->mediumText('notes')->nullable();
            $table->mediumText('description')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('officer_id')->references('id')->on('users');
            $table->foreignId('report_type_id')->references('id')->on('report_types');
            $table->boolean('is_closed')->default(0);
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
        Schema::dropIfExists('reports');
    }
}
