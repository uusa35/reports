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
            $table->string('first_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('sur_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('civil_id_no');
            $table->string('reference_no')->nullable();
            $table->string('file_no')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('personal_image')->nullable();
            $table->string('civil_id_image')->nullable();
            $table->string('city')->nullable();
            $table->string('block')->nullable();
            $table->string('street')->nullable();
            $table->string('house_no')->nullable();
            $table->string('nationality')->nullable()->default('Kuwaiti');
//            $table->string('department')->nullable();
            $table->string('section')->nullable();
            $table->string('age')->nullable();
            $table->boolean('is_officer')->default(0);
            $table->boolean('is_admin')->default(0);
            $table->boolean('active')->default(0);
            $table->timestamp('email_verified_at')->nullable();

            $table->foreignId('governate_id')->nullable()->constrained();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->mediumText('description')->nullable();
            $table->mediumText('health_issues')->nullable();

            $table->boolean('has_driving_license')->default(1);
            $table->string('driving_license_no')->nullable();
            $table->date('driving_license_issuance')->nullable();
            $table->date('driving_license_expiry')->nullable();
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
