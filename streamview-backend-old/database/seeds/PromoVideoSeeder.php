<?php

use Illuminate\Database\Seeder;

class PromoVideoSeeder extends Seeder
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
		    	'key' => 'is_promo_video_enabled' ,
		    	'value' => YES,
		    	'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s')
		    ],
            [
                'key' => 'promo_video' ,
                'value' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
		]);
    }
}
