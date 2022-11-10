<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('discord_threads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guild_id');
            $table->unsignedBigInteger('thread_id')->index();
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('owner_id');
            $table->unsignedInteger('message_count');
            $table->unsignedInteger('type');
            $table->string('name');
            $table->unsignedInteger('member_count');
            $table->boolean('archived')->index();
            $table->dateTime('thread_started_at')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discord_threads');
    }
};
