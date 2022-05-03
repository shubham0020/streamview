<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Helpers\Helper;

use File, Log, Setting;

use App\AdminVideo;

class PlayerDataJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $admin_video_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($admin_video_id)
    {
       $this->admin_video_id = $admin_video_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {

        \Log::info($this->admin_video_id);

        // Load Video Model

        $admin_video_details = AdminVideo::where('id', $this->admin_video_id)->first();

        // Log::info("admin_video_details".print_r($admin_video_details, true));
     
        if($admin_video_details) {

            // check video is eligible for player data

            $main_video_resolutions = $trailer_video_resolutions = $main_video_subtitles = $trailer_video_subtitles = $download_video_resolutions = [];

            if($admin_video_details->video_type == VIDEO_TYPE_UPLOAD && $admin_video_details->video_upload_type == VIDEO_UPLOAD_TYPE_DIRECT) {

                // main_video_resolutions

                $video_resolutions = explode(',', $admin_video_details->video_resolutions);

                if($video_resolutions) {

                    foreach ($video_resolutions as $key => $value) {

                        $main_video_resolution_data = new \stdClass();

                        $main_video_resolution_data->title = $value;

                        $main_video_resolution_data->resolution = $value;

                        $video_link_name = $value.get_video_end($admin_video_details->video);

                        // $main_video_resolution_data->video = Helper::convert_hls_to_secure($video_link_name, $admin_video_details->video); // @todo

                        $main_video_resolution_data->video = Setting::get('HLS_STREAMING_URL').$video_link_name;

                        $main_video_resolution_data->download_video = envfile('APP_URL').VIDEO_PATH.$video_link_name;

                        $main_video_resolution_data->is_default = 0;
                        
                        array_push($main_video_resolutions, $main_video_resolution_data);

                    }

                    $main_video_resolution_data = new \stdClass();

                    $main_video_resolution_data->title = "Original";

                    $main_video_resolution_data->resolution = "HD";

                    // $main_video_resolution_data->video = Helper::convert_hls_to_secure(get_video_end($admin_video_details->video), $admin_video_details->video);

                    $main_video_resolution_data->video = Setting::get('HLS_STREAMING_URL').get_video_end($admin_video_details->video);

                    $main_video_resolution_data->is_default = 1;
                    
                    array_push($main_video_resolutions, $main_video_resolution_data);

                }

                // download video data

                $download_video_resolutions = $main_video_resolutions;

                // trailer_video_resolutions start

                $t_video_resolutions = explode(',', $admin_video_details->trailer_video_resolutions);

                if($t_video_resolutions) {

                    foreach ($t_video_resolutions as $key => $value) {

                        $trailer_video_resolution_data = new \stdClass();

                        $trailer_video_resolution_data->title = $value;

                        $trailer_video_resolution_data->resolution = $value;

                        $video_link_name = $value.get_video_end($admin_video_details->video);

                        // $trailer_video_resolution_data->video = Helper::convert_hls_to_secure($video_link_name, $admin_video_details->video); // @todo

                        $trailer_video_resolution_data->video = Setting::get('HLS_STREAMING_URL').$video_link_name;

                        $trailer_video_resolution_data->download_video = envfile('APP_URL').VIDEO_PATH.$video_link_name;

                        $trailer_video_resolution_data->is_default = 0;
                        
                        array_push($trailer_video_resolutions, $trailer_video_resolution_data);

                    }

                    $trailer_video_resolution_data = new \stdClass();

                    $trailer_video_resolution_data->title = "Original";

                    $trailer_video_resolution_data->resolution = "HD";

                    // $trailer_video_resolution_data->video = Helper::convert_hls_to_secure(get_video_end($admin_video_details->video), $admin_video_details->video);
                    // 
                    $trailer_video_resolution_data->video = Setting::get('HLS_STREAMING_URL').get_video_end($admin_video_details->video);

                    $trailer_video_resolution_data->is_default = 1;
                    
                    array_push($trailer_video_resolutions, $trailer_video_resolution_data);

                }

                // trailer_video_resolutions end

            }

            if($admin_video_details->video_subtitle) {

                $video_subtitle_data = new \stdClass;

                $video_subtitle_data->title = "English";

                $video_subtitle_data->short_name = "En";

                $video_subtitle_data->subtitle = $admin_video_details->video_subtitle;
                
                $video_subtitle_data->is_default = YES;

                array_push($main_video_subtitles, $video_subtitle_data);

            }

            Log::info("main_video_subtitles".print_r($main_video_subtitles, true));

            if($admin_video_details->trailer_subtitle) {

                $trailer_subtitle_data = new \stdClass;

                $trailer_subtitle_data->title = "English";

                $trailer_subtitle_data->short_name = "En";

                $trailer_subtitle_data->subtitle = $admin_video_details->trailer_subtitle;
                
                $trailer_subtitle_data->is_default = YES;

                array_push($trailer_video_subtitles, $trailer_subtitle_data);

            }

            Log::info("trailer_video_subtitles".print_r($trailer_video_subtitles, true));
            
            $data = [
                'main_video_resolutions' => $main_video_resolutions, 
                'trailer_video_resolutions' => $trailer_video_resolutions, 
                'trailer_video_subtitles' => $trailer_video_subtitles, 
                'main_video_subtitles' => $main_video_subtitles, 
                'download_video_resolutions' => $download_video_resolutions
            ];

            $data = json_encode($data);

            Log::info("json data".print_r($data, true));

            $file_name = "player-data-".$admin_video_details->id.".json";

            $folder = public_path('uploads/video-json/');

            if (!is_dir($folder)) {  mkdir($folder,0777,true);  }
            
            \File::put($folder.$file_name,$data);

            $admin_video_details->player_json = url('/uploads/video-json/'.$file_name);

            $admin_video_details->save();

            Log::info("file_path".$folder);

        } else {

            Log::info("DEAD END");

        }
    }
}
