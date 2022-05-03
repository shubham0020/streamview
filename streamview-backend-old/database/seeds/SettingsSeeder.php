<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
public function run()
    {
        DB::table('settings')->delete();
        DB::table('settings')->insert([
            [
                'key' => 'site_name',
                'value' => 'StreamHash'
            ],
            [
                'key' => 'site_logo',
                'value' => envfile('APP_URL').'/logo.png'
            ],
            [
                'key' => 'site_icon',
                'value' => envfile('APP_URL').'/favicon.png'
            ],
            [
                'key' => 'tag_name',
                'value' => ''
            ],
            [
                'key' => 'browser_key',
                'value' => ''
            ],
            [
                'key' => 'default_lang',
                'value' => 'en'
            ], 
            [
                'key' => 'currency',
                'value' => '$'
            ],
            [
                'key' => 'admin_delete_control',
                'value' => 0        
            ],
            [
                'key' => 'installation_process',
                'value' => 0
            ],
            [
                'key' => 'amount',
                'value' => 10
            ],
            [
                'key' => 'expiry_days',
                'value' => 28
            ],
            [
                'key' => 'admin_take_count',
                'value' => 12
            ],
            [
                'key' => 'google_analytics',
                'value' => ""
            ],
            [
                'key' => 'streaming_url',
                'value' => ''
            ],
            [
                'key' => 'video_compress_size',
                'value' => 50
            ],
            [
                'key' => 'image_compress_size',
                'value' => 8
            ],
            [
                'key' => 's3_bucket',
                'value' => ''
            ],
            [
                'key' => 'track_user_mail',
                'value' => ''
            ],
            [
                'key' => 'REPORT_VIDEO',
                'value' => 'Sexual content'
            ],
            [
                'key' => 'REPORT_VIDEO',
                'value' => 'Violent or repulsive content.'
            ],
            [
                'key' => 'REPORT_VIDEO',
                'value' => 'Hateful or abusive content.'
            ],
            [
                'key' => 'REPORT_VIDEO',
                'value' => 'Harmful dangerous acts.'
            ],
            [
                'key' => 'REPORT_VIDEO',
                'value' => 'Child abuse.'
            ],
            [
                'key' => 'REPORT_VIDEO',
                'value' => 'Spam or misleading.'
            ],
            [
                'key' => 'REPORT_VIDEO',
                'value' => 'Infringes my rights.'
            ],
            [
                'key' => 'REPORT_VIDEO',
                'value' => 'Captions issue.'
            ],
            [
                'key' => 'VIDEO_RESOLUTIONS',
                'value' => '426x240'
            ],
            [
                'key' => 'VIDEO_RESOLUTIONS',
                'value' => '640x360'
            ],
            [
                'key' => 'VIDEO_RESOLUTIONS',
                'value' => '854x480'
            ],
            [
                'key' => 'VIDEO_RESOLUTIONS',
                'value' => '1280x720'
            ],
            [
                'key' => 'VIDEO_RESOLUTIONS',
                'value' => '1920x1080'
            ],
            [
                'key' => 'redeem_paypal_url',
                'value' => "https://www.sandbox.paypal.com/cgi-bin/webscr"
            ],
            [
                'key' => "custom_users_count",
                'value' => 50,
            ],
            [
                'key' => 'admin_language_control' ,
                'value' => 1,
            ],
            [
                'key' => 'post_max_size',
                'value' => "2000M"
            ],
            [
                'key' => 'upload_max_size',
                'value' => "2000M"
            ],
            [
                'key' => 'minimum_redeem' ,
                'value' => 1,
            ],
            [
                'key' => 'redeem_control' ,
                'value' => 1,
            ],
            [
                'key' => 'admin_commission' ,
                'value' => 10,
            ],
            [
                'key' => 'user_commission' ,
                'value' => 90,
            ],
            [
                'key' => 'stripe_publishable_key' ,
                'value' => "pk_test_uDYrTXzzAuGRwDYtu7dkhaF3",
            ],
            [
                'key' => 'stripe_secret_key' ,
                'value' => "sk_test_lRUbYflDyRP3L2UbnsehTUHW",
            ],
            [
                'key' => 'video_viewer_count' ,
                'value' => 10,
            ],
            [
                'key' => 'amount_per_video' ,
                'value' => 100,
            ],
            [
                'key' => "facebook_link",
                'value' => '',
            ],
            [
                'key' => "linkedin_link",
                'value' => '',
            ],
            [
                'key' => "twitter_link",
                'value' => '',
            ],
            [
                'key' => "google_plus_link",
                'value' => '',
            ],
            [
                'key' => "pinterest_link",
                'value' => '',
            ],
            [
                'key' => "instagram_link",
                'value' => '',
            ],
            [
                'key' => "appstore",
                'value' => "",
            ],
            [
                'key' => "playstore",
                'value' => "",
            ],
            [
                'key' => "copyright_content",
                'value' => "Copyrights 2018 . All rights reserved.",
            ],
            [
                'key' => "contact_email",
                'value' => "",
            ],
            [
                'key' => "contact_address",
                'value' => "",
            ],
            [
                'key' => "contact_mobile",
                'value' => "",
            ],
            [
                'key' => 'watermark_logo' ,
                'value' => asset('watermark_logo.png'),
            ],
            [
                'key' => 'referral_earnings',
                'value' => 10,
            ],
            [
                'key' => 'referrer_earnings',
                'value' => 10,
            ],

            [
                'key' => 'download_video_expiry_days',
                'value' => 3,
            ],
            [
                'key' => 'is_jwplayer_configured_mobile',
                'value' => 1,
            ],
            [
                'key' => 'jwplayer_key_mobile',
                'value' => '3FqL/SpvVBWLTmzbGsWMN5QGtFxz/V+KTAH2uZpHiNZTK7G2g91lMuiGeuwcZ+fR',
            ],
            [
                'key' => 'currency_code',
                'value' => 'USD',
            ],
            [
                'key' => 'max_banner_count',
                'value' => 6,
            ],
            [
                'key' => 'max_home_count',
                'value' => 6,
            ],
            [
                'key' => 'max_original_count',
                'value' => 20,
            ],
            [
                'key' => 'is_home_category_feature',
                'value' => NO,
            ],
            [
                'key' => 'token_expiry_hour',
                'value' => 1000000
            ],
            [
                'key' => 'is_subscription',
                'value' => 1
            ],
            [
                'key' => 'is_spam',
                'value' => 1
            ],
            [
                'key' => 'is_payper_view',
                'value' => 1
            ],
            [
                'key' => "socket_url",
                'value' => "",
            ],
            [
                'key' => 'FB_CLIENT_ID' ,
                'value' => '',
            ],
            [
                'key' => 'FB_CLIENT_SECRET' ,
                'value' => '',
            ],
            [
                'key' => 'FB_CALL_BACK' ,
                'value' => '',
            ],
            [
                'key' => 'TWITTER_CLIENT_ID' ,
                'value' => '',
            ],
            [
                'key' => 'TWITTER_CLIENT_SECRET' ,
                'value' => '',
            ],
            [
                'key' => 'TWITTER_CALL_BACK' ,
                'value' => '',
            ],
            [
                'key' => 'GOOGLE_CLIENT_ID' ,
                'value' => '',
            ],
            [
                'key' => 'GOOGLE_CLIENT_SECRET' ,
                'value' => '',
            ],
            [
                'key' => 'GOOGLE_CALL_BACK' ,
                'value' => '',
            ],
            [
                'key' => 'social_email_suffix',
                'value' => '@streamhash.com'
            ],

            [
                'key' => 'meta_title',
                'value' => "STREAMVIEW",
            ],
            [
                'key' => 'meta_description',
                'value' => "STREAMVIEW",
            ],
            [
                'key' => 'meta_author',
                'value' => "STREAMVIEW",
            ],

            [
                'key' => 'meta_keywords',
                'value' => "STREAMVIEW",
            ],

            [
                'key' => 'header_scripts',
                'value' => ""
            ],
            [
                'key' => 'body_scripts',
                'value' => ""
            ],
            [
                'key' => 'ANGULAR_SITE_URL',
                'value' => "",
            ],

            [
                'key' => 'is_push_notification',
                'value' => ON
            ],
            [
                'key' => 'no_of_static_pages',
                'value' => 8
            ],
            [
                'key' => 'MAILGUN_PUBLIC_KEY',
                'value' => ""
            ],
            [
                'key' => 'MAILGUN_PRIVATE_KEY',
                'value' => ""
            ],
            [
                'key' => 'is_mailgun_check_email',
                'value' => 0
            ],
            [
                'key' => "ios_payment_subscription_status",
                'value' => 0,
            ],
            [
                'key' => 'prefix_file_name',
                'value' => "SV"
            ],
            [
                'key' => "ffmpeg_installed",
                'value' => 1,
            ],

            [
                'key' => "email_verify_control",
                'value' => 0,
            ],

            [
                'key' => "email_notification",
                'value' => 1,
            ],

            [
                'key' => 'demo_admin_email',
                'value' => '',
            ],

            [
                'key' => 'is_watermark',
                'value' => '',
            ],

        ]);

        if(Schema::hasTable('settings')) {

            $data = DB::table('settings')->whereIn('key' , ["JWPLAYER_KEY" , 'HLS_STREAMING_URL','JWPLAYER_KEY_ANDRIOD','JWPLAYER_KEY_IOS'])->delete();

            DB::table('settings')->insert([
                [
                    'key' => 'JWPLAYER_KEY',
                    'value' => 'M2NCefPoiiKsaVB8nTttvMBxfb1J3Xl7PDXSaw==',
                ],
                [
                    'key' => 'HLS_STREAMING_URL' ,
                    'value' => '',
                ],
                [
                    'key' => 'JWPLAYER_KEY_ANDRIOD' ,
                    'value' => '',
                ],
                [
                    'key' => 'JWPLAYER_KEY_IOS' ,
                    'value' => '',
                ],
                [
                    'key' => 'video_player_type' ,
                    'value' => FREE_PLAYER
                ]
            ]);
        }

        if(Schema::hasTable('settings')) {

            $check_setting_rtmp = DB::table('settings')->where('key' , 'RTMP_SECURE_VIDEO_URL')->count();

            if(!$check_setting_rtmp) {

                $rtmp_settings = DB::table('settings')->insert([
                    [
                        'key' => 'RTMP_SECURE_VIDEO_URL',
                        'value' => '',
                    ],
                ]);

            }

            $check_setting_hls = DB::table('settings')->where('key' , 'HLS_SECURE_VIDEO_URL')->count();

            if(!$check_setting_hls) {

                $hls_settings = DB::table('settings')->insert([
                    [
                        'key' => 'HLS_SECURE_VIDEO_URL',
                        'value' => '',
                    ],
                ]);

            }

            $check_setting_smil = DB::table('settings')->where('key' , 'VIDEO_SMIL_URL')->count();

            if(!$check_setting_smil) {

                $hls_settings = DB::table('settings')->insert([
                    [
                        'key' => 'VIDEO_SMIL_URL',
                        'value' => '',
                    ],
                ]);

            }

        }
    }
}
