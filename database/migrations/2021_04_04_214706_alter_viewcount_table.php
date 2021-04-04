<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterViewcountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('viewcount', function (Blueprint $table) {
            $table->dropForeign('viewcount_post_id_foreign');
        });

        Schema::table('viewcount', function (Blueprint $table) {
            $table->integer('post_id')->nullable()->unsigned()->change();
            $table->morphs('view');
            $table->index(['view_type', 'view_id', 'ip'], 'search_ip');
        });

        \App\Models\Viewcount::whereNotNull('post_id')
            ->update([
                'view_type' => \App\Models\Post::class,
                'view_id' => DB::raw('post_id'),
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('viewcount', function (Blueprint $table) {
            $table->integer('post_id')->nullable(false)->unsigned()->change();
            $table->dropMorphs('view');
            $table->dropIndex('search_ip');
        });
        Schema::table('viewcount', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }
}
