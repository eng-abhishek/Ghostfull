<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->string('slug',100);
            $table->string('short_description', 150);
            $table->enum('interval',['Monthly','Yearly','Lifetime'])->default('Lifetime');
            $table->double('price', 10, 2);
            $table->string('storage_space',255)->nullable();
            $table->string('size_per_file',255)->nullable();
            $table->bigInteger('file_expired_in')->nullable();
            $table->string('upload_at_once',255);
            $table->enum('password_protection',['Y','N'])->default('N');
            $table->enum('advertisements',['Y','N'])->default('N');
            $table->enum('direct_linking',['Y','N'])->default('N');
            $table->enum('image_resizing',['Y','N'])->default('N');   
            $table->enum('is_login_required',['Y','N'])->default('Y');
            $table->enum('is_free_plan',['Y','N'])->default('N');    
            $table->enum('is_featured_plan',['Y','N'])->default('N');    
            $table->longText('other_features')->nullable();
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
        Schema::dropIfExists('plans');
    }
}
