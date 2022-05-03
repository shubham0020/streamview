<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSkipIntroSecondsToAdminVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_videos', function (Blueprint $table) {
            $table->integer('skip_intro_seconds')->default(0);
            $table->integer('skip_intro_start')->default(0);
            $table->integer('skip_intro_end')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_videos', function (Blueprint $table) {
            $table->dropColumn('skip_intro_seconds');
            $table->dropColumn('skip_intro_start');
            $table->dropColumn('skip_intro_end');
        });
    }
}
