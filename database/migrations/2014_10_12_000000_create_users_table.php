<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('civil_id_no');
            $table->string('mobile')->nullable();
            $table->string('personal_image')->nullable();
            $table->string('civil_id_image')->nullable();
            $table->string('address')->nullable();
            $table->boolean('is_officer')->default(0);
            $table->boolean('is_admin')->default(0);
            $table->boolean('active')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('report_type_id')->references('id')->on('report_types');
            $table->mediumText('description')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
