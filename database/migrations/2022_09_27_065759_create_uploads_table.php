<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255);
            $table->string('slug',255);
            $table->string('storage_space',255)->nullable();
            $table->string('size_per_file',255)->nullable();
            $table->bigInteger('file_expired_in')->nullable();
            $table->string('upload_at_once',255);
            $table->enum('password_protection',['Y','N'])->default('N');
            $table->enum('advertisements',['Y','N'])->default('N');
            $table->enum('is_active',['Y','N'])->default('N');
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
        Schema::dropIfExists('uploads');
    }
}
