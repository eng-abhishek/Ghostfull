<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_uploads', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('shared_id',100)->unique();
            $table->bigInteger('storage_provider_id')->unsigned();
            $table->string('filename',255);
            $table->string('filepath',255);
            $table->string('name',255);
            $table->string('mime',100)->nullable();
            $table->bigInteger('size')->default(0);
            $table->string('extension',10)->nullable();
            $table->string('type',100);
            $table->enum('visibility',['Public','Private','Protected'])->default('Public');
            $table->string('password',255)->nullable();
            $table->bigInteger('downloads')->default(0);
            $table->bigInteger('views')->default(0);
            $table->datetime('expiry_at')->nullable();
            $table->datetime('deleted_at')->nullable();
            $table->timestamp('created_at');
            $table->datetime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_uploads');
    }
}
