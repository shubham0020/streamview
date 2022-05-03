<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use File, Log, Setting; 

use App\Helpers\Helper;

use App\AdminVideo, App\Notification, App\EmailTemplate, App\Category;

use App\Repositories\PushNotificationRepository as PushRepo;

class StreamviewWaterMarkDrmVideo extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $admin_video_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($admin_video_id) {
        
       $this->admin_video_id = $admin_video_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {

        $admin_video_details = AdminVideo::where('id', $this->admin_video_id)->first();

        if($admin_video_details) {

            // Add water mark for the video 

            \App\Repositories\VideoRepository::add_watermark_to_video($admin_video_details->video);

            \App\Repositories\VideoRepository::add_watermark_to_video($admin_video_details->trailer_video);

            \App\Repositories\VideoRepository::promo_video($admin_video_details->video);

            \App\Repositories\VideoRepository::promo_video($admin_video_details->trailer_video);
            
            // \App\Repositories\VideoRepository::add_drm_to_video($admin_video_details);


        }  else {

            Log::info("Video not found..! - ".$this->admin_video_id);
        }
    }
}
