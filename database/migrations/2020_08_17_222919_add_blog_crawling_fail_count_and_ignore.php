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
        Schema::table('blogs', function (Blueprint $table) {
            $table->unsignedInteger('crawling_fail_count')->default(0);
            $table->dateTime('last_crawling_failed_at')->nullable();
            $table->boolean('ignore_crawling')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('crawling_fail_count');
            $table->dropColumn('last_crawling_failed_at');
            $table->dropColumn('ignore_crawling');
        });
    }
};
