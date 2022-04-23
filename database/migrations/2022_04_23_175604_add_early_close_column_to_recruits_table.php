<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEarlyCloseColumnToRecruitsTable extends Migration
{
    public function up(): void
    {
        Schema::table('recruits', function (Blueprint $table) {
            $table->dateTime('closed_at')->nullable()->index();
            $table->foreignId('closed_user_id')->nullable()->index();
        });
    }

    public function down(): void
    {
        Schema::table('recruits', function (Blueprint $table) {
            $table->dropColumn('closed_at');
            $table->dropColumn('closed_user_id');
        });
    }
}
