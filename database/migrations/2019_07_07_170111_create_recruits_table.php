<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruits', function (Blueprint $table) {
            $table->increments('id');
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
            $table->integer('entry_user_id')->unsigned();
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
}
