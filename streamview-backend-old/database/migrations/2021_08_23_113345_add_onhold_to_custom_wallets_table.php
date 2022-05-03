<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOnholdToCustomWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('custom_wallets', function (Blueprint $table) {
            $table->float('onhold')->default(0.00);
        });

        Schema::create('referral_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id');
            $table->integer('user_id');
            $table->integer('parent_user_id');
            $table->integer('referral_code_id');
            $table->string('referral_code')->default("");
            $table->float('referral_amount')->default(0.00);
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
        Schema::table('custom_wallets', function (Blueprint $table) {
            $table->dropColumn('onhold');
        });
    }
}
