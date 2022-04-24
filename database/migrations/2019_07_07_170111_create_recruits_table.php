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
        Schema::create('recruits', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company_name');
            $table->text('description');
            $table->string('skills');
            $table->string('link');
            $table->string('image_url')->nullable();
            $table->string('address');
            $table->integer('min_salary')->nullable()->index();
            $table->integer('max_salary')->nullable()->index();
            $table->date('expired_at')->index();
            $table->foreignId('entry_user_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('entry_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recruits');
    }
};
