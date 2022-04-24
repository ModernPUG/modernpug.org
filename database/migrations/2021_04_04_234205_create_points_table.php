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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('ad_point')->index()->default(0)->comment('광고 포인트');
            $table->unsignedInteger('skill_point')->index()->default(0)->comment('기술 포인트');
            $table->unsignedInteger('community_point')->index()->default(0)->comment('커뮤니티 포인트');
            $table->unsignedInteger('used_point')->index()->default(0)->comment('사용완료 포인트');
            $table->unsignedInteger('remain_point')->index()->default(0)->comment('잔여 포인트');
        });

        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedInteger('point');
            $table->nullableMorphs('point');
            $table->foreignId('give_user_id')->nullable()->index();
            $table->foreignId('receive_user_id')->index();
            $table->timestamp('created_at')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ad_point');
            $table->dropColumn('skill_point');
            $table->dropColumn('community_point');
            $table->dropColumn('used_point');
            $table->dropColumn('remain_point');
        });

        Schema::dropIfExists('points');
    }
};
