<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    public function up()
    {
        Schema::create('viewcount', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->index();
            $table->string('ip', 45)->index();
            $table->timestamps();
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('viewcount');
    }
};
