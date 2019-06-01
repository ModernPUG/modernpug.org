<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArticleToPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->rename('posts');
        });

        Schema::table('viewcount', function (Blueprint $table) {
            $table->renameColumn('article_id', 'post_id');
        });

        Schema::table('article_tag', function (Blueprint $table) {
            $table->renameColumn('article_id', 'post_id');
            $table->rename('post_tag');
        });

        Schema::table('previews', function (Blueprint $table) {
            $table->renameColumn('article_id', 'post_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->rename('articles');
        });

        Schema::table('viewcount', function (Blueprint $table) {
            $table->renameColumn('post_id', 'article_id');
        });

        Schema::table('post_tag', function (Blueprint $table) {
            $table->renameColumn('post_id', 'article_id');
            $table->rename('article_tag');
        });

        Schema::table('previews', function (Blueprint $table) {
            $table->renameColumn('post_id', 'article_id');
        });
    }
}
