<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title')->nullable();
            $table->string('feed_url')->unique();
            $table->string('site_url')->nullable();
            $table->longText('description')->nullable();
            $table->text('image_url')->nullable();
            $table->integer('entry_user_id')->unsigned()->nullable();
            $table->text('comment')->nullable();
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
        Schema::drop('blogs');
    }
}
