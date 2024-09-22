<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('driver',255);
            $table->string('host',255);
            $table->integer('port');
            $table->enum('encryption',['tls','ssl']);
            $table->string('password');
            $table->string('from_name');
            $table->string('from_email');
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
        Schema::dropIfExists('mailers');
    }
}
