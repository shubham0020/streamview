<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPlayerJsonToAdminVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_videos', function (Blueprint $table) {
            $table->string('player_json')->default("");
            $table->string('mobile_banner_image')->after('banner_image');
        });

        Schema::create('admin_video_subtitles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_video_id');
            $table->string('title');
            $table->string('short_name');
            $table->string('subtitle');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
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
            $table->dropColumn('player_json');
        });
        Schema::drop('admin_video_subtitles');
    }
}
