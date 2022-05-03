<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Repositories\PushNotificationRepository as PushRepo;

use Log,Exception, Setting;

use App\Notifications\PushNotification as PushNotify;

class PushNotification extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $push_notification_type;

    protected $title;

    protected $message;

    protected $data;

    protected $register_ids;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($push_notification_type = PUSH_TO_ALL , $title , $message, $data = [] , $register_ids = [])
    {
        $this->push_notification_type = $push_notification_type;

        $this->title = $title;

        $this->message = $message;

        $this->data = $data;

        $this->register_ids = $register_ids;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        Log::info("PushNotification Job Queue: Start");


        if(Setting::get('is_push_notification') == ON && envfile('FCM_SENDER_ID')!='' && envfile('FCM_SERVER_KEY')!='') {

            if($this->push_notification_type == PUSH_TO_ALL) {
                
                Log::info("PushNotification Job Queue: PUSH_TO_ALL");

                $register_ids = User::where('status' , USER_APPROVED)->where('device_token' , '!=' , "")->whereIn('device_type' , [DEVICE_ANDROID,DEVICE_IOS])->where('push_status' , ON)->pluck('device_token')->toArray();

                \Notification::send($register_ids, new PushNotify($this->title , $this->message, $this->data, $register_ids));

                // PushRepo::send_push_notification($this->push_notification_type , $this->title , $this->message, $this->data);
            
            }

            if($this->push_notification_type == PUSH_TO_ANDROID) {

                Log::info("PushNotification Job Queue: PUSH_TO_ANDROID");

                $register_ids = User::where('status' , USER_APPROVED)->where('device_token' , '!=' , "")->where('device_type' , DEVICE_ANDROID)->where('push_status' , ON)->pluck('device_token')->toArray();

                \Notification::send($register_ids, new PushNotify($this->title , $this->message, $this->data, $register_ids));

                // PushRepo::push_notification_android($this->register_ids , $this->title , $this->message);
            
            }

            if($this->push_notification_type == PUSH_TO_IOS) {

                Log::info("PushNotification Job Queue: PUSH_TO_IOS");

                $register_ids = User::where('status' , USER_APPROVED)->where('device_token' , '!=' , "")->where('device_type' , DEVICE_IOS)->where('push_status' , ON)->pluck('device_token')->toArray();

                \Notification::send($register_ids, new PushNotify($this->title , $this->message, $this->data, $register_ids));

                
                // PushRepo::push_notification_ios($this->register_ids , $this->title , $this->message);
            }

            if($this->push_notification_type == PUSH_TO_USER) {

                Log::info("PushNotification Job Queue: PUSH_TO_USER");

                \Notification::send($this->register_ids, new PushNotify($this->title , $this->message, $this->data, $this->register_ids));
           
            }

        } else {

            Log::info("PushNotification disabled by admin");
        }

        Log::info("PushNotification Job Queue: END");


    }
}
