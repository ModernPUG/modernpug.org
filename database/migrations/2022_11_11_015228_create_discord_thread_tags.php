<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('discord_thread_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('tag_id')->index();
            $table->unsignedBigInteger('thread_id')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discord_thread_tags');
    }
};
