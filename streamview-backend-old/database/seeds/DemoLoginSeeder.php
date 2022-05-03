<?php

use Illuminate\Database\Seeder;

use App\Helpers\Helper;

class DemoLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if(Schema::hasTable('admins')) {

            $check_admin = DB::table('admins')->where('email' , 'admin@streamview.com')->count();

            if(!$check_admin) {

                DB::table('admins')->insert([
                    [
                        'name' => 'Admin',
                        'email' => 'admin@streamview.com',
                        'password' => \Hash::make('123456'),
                        'picture' =>"http://adminview.streamhash.com/placeholder.png",
                        'description' => 'description',
                        'is_activated' => YES,
                        'mobile'=>'85465765',
                        'token' => Helper::generate_token(),
                        'token_expiry' => Helper::generate_token_expiry(),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]
                ]);

            }

            $check_test_admin = DB::table('admins')->where('email' , 'test@streamview.com')->count();

            if(!$check_test_admin) {

                DB::table('admins')->insert([

                    [
                        'name' => 'Test',
                        'email' => 'test@streamview.com',
                        'password' => \Hash::make('123456'),
                        'picture' =>"http://adminview.streamhash.com/placeholder.png",
                        'description' => 'description',
                        'is_activated' => YES,
                        'mobile'=>'85465765',
                        'token' => Helper::generate_token(),
                        'token_expiry' => Helper::generate_token_expiry(),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ],
                ]);
            }
        
        }

        if(Schema::hasTable('users')) {

            $check_user = DB::table('users')->where('email' , 'user@streamview.com')->count();

            if(!$check_user) {

                DB::table('users')->insert([
                    [
                        'name' => 'User',
                        'email' => 'user@streamview.com',
                        'password' => \Hash::make('123456'),
                        'picture' =>"http://adminview.streamhash.com/placeholder.png",
                        'login_by' =>"manual",
                        'device_type' =>"web",
                        'is_activated' =>1,
                        'status' =>1,
                        'user_type' =>1,
                        'is_verified' =>1,
                        'token' => Helper::generate_token(),
                        'token_expiry' => Helper::generate_token_expiry(),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]
                ]);

            }

            $check_test_user = DB::table('users')->where('email' , 'test@streamview.com')->count();

            if(!$check_test_user) {

                DB::table('users')->insert([
                    [
                        'name' => 'Test',
                        'email' => 'test@streamview.com',
                        'password' => \Hash::make('123456'),
                        'picture' =>"http://adminview.streamhash.com/placeholder.png",
                        'login_by' =>"manual",
                        'device_type' =>"web",
                        'is_activated' =>1,
                        'status' =>1,
                        'user_type' =>1,
                        'is_verified' =>1,
                        'token' => Helper::generate_token(),
                        'token_expiry' => Helper::generate_token_expiry(),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ],
                ]);
            }
        
        }

        if(Schema::hasTable('moderators')) {

            $check_details = DB::table('moderators')->where('email' , 'moderator@streamview.com')->count();

            if(!$check_details) {
                DB::table('moderators')->insert([
                    [
                        'name' => 'Moderator',
                        'email' => 'moderator@streamview.com',
                        'password' => \Hash::make('123456'),
                        'token' => Helper::generate_token(),
                        'token_expiry' => Helper::generate_token_expiry(),
                        'is_activated'=>1,
                        'description' => 'description',
                        'mobile'=>'85465765',
                        'token' => Helper::generate_token(),
                        'token_expiry' => Helper::generate_token_expiry(),
                        'picture' =>"http://adminview.streamhash.com/placeholder.png",
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]
                ]);
            }

            $check_test_details = DB::table('moderators')->where('email' , 'test@streamview.com')->count();

            if(!$check_test_details) {

                DB::table('moderators')->insert([
                    [
                        'name' => 'Moderator',
                        'email' => 'test@streamview.com',
                        'password' => \Hash::make('123456'),
                        'token' => Helper::generate_token(),
                        'token_expiry' => Helper::generate_token_expiry(),
                        'is_activated'=>1,
                        'description' => 'description',
                        'mobile'=>'85465765',
                        'token' => Helper::generate_token(),
                        'token_expiry' => Helper::generate_token_expiry(),
                        'picture' =>"http://adminview.streamhash.com/placeholder.png",
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]
                ]);
            }
        }
    }
}
