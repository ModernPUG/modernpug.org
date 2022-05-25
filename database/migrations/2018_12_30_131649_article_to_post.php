<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('viewcount', function (Blueprint $table) {
            $table->dropForeign('viewcount_article_id_foreign');
        });

        Schema::table('viewcount', function (Blueprint $table) {
            $table->dropIndex('viewcount_article_id_index');
        });

        Schema::table('article_tag', function (Blueprint $table) {
            $table->dropForeign('article_tag_article_id_foreign');
        });

        Schema::table('article_tag', function (Blueprint $table) {
            $table->dropIndex('article_tag_article_id_index');
        });

        Schema::table('previews', function (Blueprint $table) {
            $table->dropForeign('previews_article_id_foreign');
        });

        Schema::table('previews', function (Blueprint $table) {
            $table->dropIndex('previews_article_id_foreign');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->rename('posts');
        });

        Schema::table('viewcount', function (Blueprint $table) {
            $table->renameColumn('article_id', 'post_id');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });

        Schema::table('article_tag', function (Blueprint $table) {
            $table->renameColumn('article_id', 'post_id');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->rename('post_tag');
        });

        Schema::table('previews', function (Blueprint $table) {
            $table->renameColumn('article_id', 'post_id');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
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
};
