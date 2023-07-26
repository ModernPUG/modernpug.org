<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discord_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->index()->unique();
            $table->string('name')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discord_tags');
    }
};
