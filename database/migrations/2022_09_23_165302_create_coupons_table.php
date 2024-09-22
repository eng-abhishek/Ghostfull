<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->string('name',100)->nullable();
            $table->string('code', 100);
            $table->bigInteger('plan_id')->nullable()->unsigned();
            $table->text('description')->nullable();
            $table->enum('discount_type',['fixed','percentage'])->default('fixed');            
            $table->bigInteger('discount_amount')->nullable();
            $table->bigInteger('limit_per_user');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->datetime('deleted_at')->nullable();
            $table->foreign("plan_id")->references("id")->on('plans')->onDelete('cascade');
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
        Schema::dropIfExists('coupons');
    }
}
