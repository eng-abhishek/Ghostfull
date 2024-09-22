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
        $table->bigIncrements('id');
        $table->string('firstname',255)->nullable();
        $table->string('lastname',255)->nullable();
        $table->string('username', 255)->unique()->nullable();
        $table->string('email', 255)->unique();
        $table->dateTime('email_verified_at')->nullable();
        $table->string('phone_number', 20)->unique()->nullable();
        $table->string('password',255);
        $table->string('avatar',255)->nullable();
        $table->string('address')->nullable();
        $table->enum('is_admin',['Y','N'])->default('N');
        $table->enum('is_active',['Y','N'])->default('Y');
        $table->datetime('last_login_at')->nullable();
        $table->string('last_login_ip',100)->nullable();   
        $table->enum('is_two_factor_enable',['Y','N'])->default('N');
        $table->string('two_factor_code',100)->nullable();   
        $table->dateTime('two_factor_expired_at')->nullable();
        $table->softDeletes();
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
