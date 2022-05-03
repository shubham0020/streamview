<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminVideoAudioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_video_audio', function (Blueprint $table) {
            $table->id();
            $table->integer('video_id');
            $table->string('language');
            $table->string('language_code');
            $table->string('subtitle')->default('');
            $table->string('subtitle_vtt')->default('');
            $table->string('audio')->default('');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('admin_video_audio');
    }
}
