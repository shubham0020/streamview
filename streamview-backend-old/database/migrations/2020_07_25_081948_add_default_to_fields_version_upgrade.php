<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultToFieldsVersionUpgrade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_payments', function (Blueprint $table) {
            $table->text('cancel_reason')->nullable()->change();
        });

        Schema::table('custom_wallet_vouchers', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
        });

        Schema::table('admins', function (Blueprint $table) {
            $table->integer('is_activated')->default(YES)->change();
            $table->string('mobile')->nullable()->change();
            $table->string('paypal_email')->default("")->change();
            $table->string('address')->default("")->change();
            $table->string('timezone')->default('America/Los_Angeles')->change();
            $table->integer('admin_type')->comments('1 - SUPER ADMIN , 2 - ADMIN , 3 - SUB ADMIN')->default(1)->change();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('device_token')->default("")->change();
            $table->integer('mobile')->nullable()->change();
            $table->string('paypal_email')->default("")->change();
            $table->string('address')->default("")->change();
            $table->string('timezone')->default('America/Los_Angeles')->change();
            $table->string('social_unique_id')->default("")->change();
            $table->string('fb_lg')->default("")->change();
            $table->string('gl_lg')->default("")->change();
            $table->string('description')->default("")->change();
            $table->integer('is_activated')->default(YES)->change();
            $table->string('mobile')->default("")->change();
            $table->integer('email_notification_status')->default(0)->change();
            // $table->integer('push_notification_status')->default(0)->change();
            $table->integer('no_of_account')->default(0)->change();
            $table->integer('logged_in_account')->default(0)->change();
            $table->string('payment_mode')->default(COD)->change();
            $table->string('card_id')->default(0)->change();
            $table->string('verification_code')->default('')->change();
            $table->string('verification_code_expiry')->default('')->change();
            $table->string('timezone')->default('America/Los_Angeles')->change();
            $table->integer('is_verified')->default(NO)->change();
            $table->integer('status')->default(NO)->change();
            $table->integer('push_status')->default(NO)->change();
            $table->integer('user_type')->default(NO)->change();
            $table->string('user_type_change_by')->default("")->change();
            $table->integer('is_moderator')->default(NO)->change();
            $table->integer('moderator_id')->default(NO)->change();
            $table->integer('no_of_days')->default(0)->change();

            \DB::statement('ALTER TABLE users modify latitude DOUBLE(15,8) DEFAULT 0;');
            \DB::statement('ALTER TABLE users modify longitude DOUBLE(15,8) DEFAULT 0;');
            \DB::statement('ALTER TABLE users modify amount_paid DOUBLE(8,2) DEFAULT 0.00;');

        });

        Schema::table('pages', function (Blueprint $table) {
            $table->string('unique_id')->default(uniqid())->change();
            $table->string('heading')->default("")->change();
            $table->text('description')->default("")->change();
            \DB::statement("ALTER TABLE pages modify type ENUM('about','privacy','terms','help','others','contact','faq') DEFAULT 'contact';");

        });

        Schema::table('moderators', function (Blueprint $table) {
            $table->string('mobile')->default("")->change();
            $table->string('paypal_email')->default("")->change();
            $table->string('address')->default("")->change();
            $table->string('timezone')->default('America/Los_Angeles')->change();
            $table->string('description')->default("")->change();
            $table->integer('is_activated')->default(YES)->change();
            $table->integer('is_user')->default(0)->change();
            $table->string('timezone')->default('America/Los_Angeles')->change();

            \DB::statement('ALTER TABLE moderators modify total DOUBLE(8,2) DEFAULT 0.00;');
            \DB::statement('ALTER TABLE moderators modify total_admin_amount DOUBLE(8,2) DEFAULT 0.00;');
            \DB::statement('ALTER TABLE moderators modify total_user_amount DOUBLE(8,2) DEFAULT 0.00;');
            \DB::statement('ALTER TABLE moderators modify paid_amount DOUBLE(8,2) DEFAULT 0.00;');
            \DB::statement('ALTER TABLE moderators modify remaining_amount DOUBLE(8,2) DEFAULT 0.00;');

        });

        Schema::table('referral_codes', function (Blueprint $table) {
            $table->string('unique_id')->default(uniqid())->change();
        });

        Schema::table('subscriptions', function (Blueprint $table) {
            $table->string('unique_id')->default(uniqid())->change();
            $table->string('subscription_type')->default('')->change();
            $table->integer('total_subscription')->default(0)->change();
            $table->integer('status')->default(0)->change();
        });

        Schema::table('coupons', function (Blueprint $table) {
            $table->string('description')->default('')->change();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->integer('is_approved')->default(YES)->change();
            $table->string('created_by')->default(ADMIN)->change();
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->string('status')->default(YES)->change();
            $table->integer('is_approved')->default(YES)->change();
            $table->string('created_by')->default(ADMIN)->change();
        });

        Schema::table('genres', function (Blueprint $table) {
            $table->string('unique_id')->default(uniqid())->change();
            $table->integer('status')->default(YES)->change();
            $table->integer('is_approved')->default(YES)->change();
            $table->string('created_by')->default(ADMIN)->change();
            $table->integer('position')->default(YES)->change();
            $table->string('subtitle')->default('')->change();
        });

        Schema::table('redeems', function (Blueprint $table) {
            
            $table->integer('status')->default(YES)->change();

            \DB::statement('ALTER TABLE redeems modify total DOUBLE(8,2) DEFAULT 0.00;');
            \DB::statement('ALTER TABLE redeems modify total_admin_amount DOUBLE(8,2) DEFAULT 0.00;');
            \DB::statement('ALTER TABLE redeems modify total_moderator_amount DOUBLE(8,2) DEFAULT 0.00;');
            \DB::statement('ALTER TABLE redeems modify paid DOUBLE(8,2) DEFAULT 0.00;');
            \DB::statement('ALTER TABLE redeems modify remaining DOUBLE(8,2) DEFAULT 0.00;');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        if(Schema::hasColumn('user_payments', 'cancel_reason')) {

            Schema::table('user_payments', function (Blueprint $table) {
                $table->dropColumn('cancel_reason');
            });
        }

        if(Schema::hasColumn('custom_wallet_vouchers', 'description')) {

            Schema::table('custom_wallet_vouchers', function (Blueprint $table) {
                $table->dropColumn('description');
            });
        }

        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('is_activated');
            $table->dropColumn('mobile');
            $table->dropColumn('paypal_email');
            $table->dropColumn('address');
            $table->dropColumn('timezone');
            $table->dropColumn('admin_type');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('device_token');
            $table->dropColumn('mobile');
            $table->dropColumn('paypal_email');
            $table->dropColumn('address');
            $table->dropColumn('timezone');
            $table->dropColumn('social_unique_id');
            $table->dropColumn('fb_lg');
            $table->dropColumn('gl_lg');
            $table->dropColumn('description');
            $table->dropColumn('is_activated');
            $table->dropColumn('mobile');
            $table->dropColumn('email_notification_status');
            $table->dropColumn('no_of_account');
            $table->dropColumn('logged_in_account');
            $table->dropColumn('payment_mode');
            $table->dropColumn('card_id');
            $table->dropColumn('verification_code');
            $table->dropColumn('verification_code_expiry');
            $table->dropColumn('timezone');
            $table->dropColumn('is_verified');
            $table->dropColumn('status');
            $table->dropColumn('push_status');
            $table->dropColumn('user_type');
            $table->dropColumn('user_type_change_by');
            $table->dropColumn('is_moderator');
            $table->dropColumn('moderator_id');
            $table->dropColumn('no_of_days');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
            $table->dropColumn('amount_paid');

        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('unique_id');
            $table->dropColumn('heading');
            $table->dropColumn('description');
            $table->dropColumn('type');
        });

        Schema::table('moderators', function (Blueprint $table) {

            $table->dropColumn('mobile');
            $table->dropColumn('paypal_email');
            $table->dropColumn('address');
            $table->dropColumn('timezone');
            $table->dropColumn('description');
            $table->dropColumn('is_activated');
            $table->dropColumn('is_user');
            $table->dropColumn('timezone');
            $table->dropColumn('total');
            $table->dropColumn('total_admin_amount');
            $table->dropColumn('total_user_amount');
            $table->dropColumn('paid_amount');
            $table->dropColumn('remaining_amount');

        });

        Schema::table('referral_codes', function (Blueprint $table) {
            $table->dropColumn('unique_id');
        });

        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn('unique_id');
            $table->dropColumn('subscription_type');
            $table->dropColumn('total_subscription');
            $table->dropColumn('status');
        });

        Schema::table('coupons', function (Blueprint $table) {
            $table->dropColumn('description');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('is_approved');
            $table->dropColumn('created_by');
        });

        Schema::table('sub_categories', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('created_by');
            $table->dropColumn('is_approved');
        });

        Schema::table('genres', function (Blueprint $table) {
            $table->dropColumn('unique_id');
            $table->dropColumn('status');
            $table->dropColumn('created_by');
            $table->dropColumn('is_approved');
            $table->dropColumn('position');
            $table->dropColumn('subtitle');
        });

        Schema::table('redeems', function (Blueprint $table) {
            
            $table->dropColumn('total');
            $table->dropColumn('status');
            $table->dropColumn('total_admin_amount');
            $table->dropColumn('total_moderator_amount');
            $table->dropColumn('paid');
            $table->dropColumn('remaining');

        });
    }
}
