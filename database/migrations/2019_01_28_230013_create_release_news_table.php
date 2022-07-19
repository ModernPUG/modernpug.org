<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('release_news', function (Blueprint $table) {
            $table->id();
            $table->string('site_url')->comment('웹 사이트의 주소');
            $table->string('type')->comment('release type (Laravel, PHP, CI)');
            $table->string('version')->comment('release version');
            $table->date('released_at')->nullable()->comment('출시일');
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
        Schema::dropIfExists('release_news');
    }
};
