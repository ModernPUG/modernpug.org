<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReleasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('releases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('웹 사이트의 타이틀');
            $table->string('site_url')->comment('웹 사이트의 주소');
            $table->string('feed_url')->comment('feed url');
            $table->string('type')->comment('release type (Laravel, PHP, CI)');
            $table->string('version')->comment('release version');
            $table->text('content')->comment('release 내용');
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
        Schema::dropIfExists('releases');
    }
}
