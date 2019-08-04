<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateViewcountTable extends Migration
{
    public function up()
    {
        Schema::create('viewcount', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->unsigned()->index();
            $table->string('ip', 45)->index();
            $table->timestamps();
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('viewcount');
    }
}
