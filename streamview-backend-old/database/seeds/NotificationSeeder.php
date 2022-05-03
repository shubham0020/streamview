<?php

use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('notification_templates')->delete();

    	DB::table('notification_templates')->insert([
    		[
		        'type' => 'NEW_VIDEO',
		        'subject'=>"'<%video_name%>' in <%site_name%>",
		        'content'=>"'<%video_name%>' video uploaded in '<%category_name%>' Category, don't miss the video from <%site_name%>",
		        'status'=> APPROVED,
		        'created_at'=>date('Y-m-d H:i:s'),
	            'updated_at'=>date('Y-m-d H:i:s')
		    ],
		    [
		        
		        'type'=>'EDIT_VIDEO',
	            'subject' => "'<%video_name%>' in <%site_name%>",
	            'content' => "'<%video_name%>' video uploaded in '<%category_name%>' Category, don't miss the video from <%site_name%>",
	            'status'=> APPROVED,
	            'created_at'=>date('Y-m-d H:i:s'),
	            'updated_at'=>date('Y-m-d H:i:s')
		    ],
		    [
	        	'template_type' => MODERATOR_UPDATE_MAIL,
	            'subject' => "Email Change Notification",
	            'description' => 'You receive this one at your old email address. Please note that this email is a security measure to protect your account in case someone is trying to take it over.  <br> <b> Your New Email Address is : <%email%> </b>',
	            'status'=>1,
	            'created_at'=>date('Y-m-d H:i:s'),
	            'updated_at'=>date('Y-m-d H:i:s')
        	],

        	[
	        	'template_type'=>AUTOMATIC_RENEWAL,
	            'subject' => "Automatic Renewal Notification",
	            'description' => "Your subscription is renewed automatically.",
	            'status'=>1,
	            'created_at'=>date('Y-m-d H:i:s'),
	            'updated_at'=>date('Y-m-d H:i:s')
        	]
		   
		]);
    }
}
