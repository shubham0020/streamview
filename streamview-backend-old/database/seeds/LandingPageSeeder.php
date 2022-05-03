<?php

use Illuminate\Database\Seeder;

class LandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('settings')->insert([
         	[
                'key' => 'common_bg_image' ,
                'value' => envfile('APP_URL').'/images/login-bg.jpg',
                'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s')
            ],
         	[
                'key' => 'home_page_bg_image' ,
                'value' => envfile('APP_URL').'/images/home_page_bg_image.jpg',
                'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s')
            ],
    		[
		        'key' => 'home_banner_heading',
		        'value' => "Unlimited movies, TV shows and more.",
		        'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s')
		    ],

		    [
		        'key' => 'home_banner_title', // @todo not used
		        'value' => "Watch anywhere. Cancel anytime.",
		        'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s')
		    ],

		    [
		        'key' => 'home_banner_description',
		        'value' => "Watch anywhere. Cancel anytime.",
		        'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s')
		    ],
		    [
		        'key' => 'home_section_1_title',
		        'value' => "Enjoy on your TV.",
		        'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s')
		    ],
		    [
		        'key' => 'home_section_1_description',
		        'value' => "Watch on smart TVs, PlayStation, Xbox, Chromecast, Apple TV, Blu-ray players and more.",
		        'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s')
		    ],
		    [
		        'key' => 'home_section_1_video',
		        'value' => envfile('APP_URL').'/images/enjoy_on_tv.m4v',
		        'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s')
		    ],
		    [
		        'key' => 'home_section_2_title',
		        'value' => "Download your shows to watch offline.",
		        'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s')
		    ],
		    [
		        'key' => 'home_section_2_description',
		        'value' => "Save your favourites easily and always have something to watch.",
		        'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s')
		    ],
		    [
		        'key' => 'home_section_2_image',
		        'value' => envfile('APP_URL').'/images/mobile.jpg',
		        'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s')
		    ],
		    [
		        'key' => 'home_section_2_mob_image',
		        'value' => envfile('APP_URL').'/images/boxshot.png',
		        'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s')
		    ],
		    [
		        'key' => 'home_section_2_image_title',
		        'value' => 'Stranger Things',
		        'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s')
		    ],
		    [
		        'key' => 'home_section_3_title',
		        'value' => "Watch everywhere.",
		        'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s')
		    ],
		    [
		        'key' => 'home_section_3_description',
		        'value' => "Stream unlimited movies and TV shows on your phone, tablet, laptop, and TV.",
		        'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s')
		    ],
		    [
		        'key' => 'home_section_3_video',
		        'value' => envfile('APP_URL').'/images/watch_everywhere.m4v',
		        'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s')
		    ],

		    [
		        'key' => 'home_section_3_cover_image',
		        'value' => envfile('APP_URL').'/images/all-device.png',
		        'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s')
		    ]
		]);
    }
}
