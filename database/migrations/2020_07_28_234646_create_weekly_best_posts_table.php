<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_bests', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->integer('week_no');
            $table->timestamps();
        });

        Schema::create('weekly_best_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('weekly_best_id');
            $table->foreignId('post_id');
            $table->unsignedInteger('point')->comment('선정 당시 부여된 포인트');
            $table->unsignedInteger('rank')->comment('선정 순위');
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
        Schema::dropIfExists('weekly_best_posts');
    }
};
