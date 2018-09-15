<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('original_name');
            $table->string('category');
            $table->string('format');
            $table->string('mimetype');
            $table->string('size');
            $table->string('storage_path');
            $table->string('public_path');
            $table->integer('downloads')->default(0);
            $table->boolean('shared')->nullable()->default(false);
            $table->string('share_token')->nullable()->default(null);
            $table->string('share_url')->nullable()->default(null);
            $table->boolean('trashed')->nullable()->default(false);
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
        Schema::dropIfExists('posts');
    }
}
