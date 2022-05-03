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

class NFAudioGenerate extends Job implements ShouldQueue
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

        $admin_video = AdminVideo::where('id', $this->admin_video_id)->first();

        if($admin_video) {

            Log::info("AdminVideo Pass");

            $admin_audios = \App\AdminVideoAudio::where('video_id', $this->admin_video_id)->get();

            if($admin_audios) {

                Log::info("admin_audios Pass");

                $audio_urls = $audio_maps = $audio_languages = "";

                foreach ($admin_audios as $key => $audio_model) {

                    if($audio_model->audio) {

                        $index = $key+1;

                        Log::info("admin_audios SINGLE Pass");

                        $audio_urls .= $audio_model->audio ? " -i ".public_path(AUDIO_PATH.get_video_end($audio_model->audio)) : "";

                        $audio_maps .= "-map ".$index.":a ";

                        $audio_languages .= " -metadata:s:a:$index language=".$audio_model->language_code." -metadata:s:a:$index title='".$audio_model->language."'";
                    }

                }

                Log::info("audio_urls".$audio_urls);

                Log::info("audio_maps".$audio_maps);

                Log::info("audio_languages".$audio_languages);

                if($audio_urls && $audio_maps && $audio_languages) {

                    $video_file_name = get_video_end($admin_video->video);

                    Log::info("video_file_name".$video_file_name);

                    $video_path = public_path(VIDEO_PATH.$video_file_name);

                    Log::info("video_path".$video_path);

                    $video_file_name_new = 'audio-'.get_video_end($admin_video->video);

                    Log::info("video_file_name_new".$video_file_name_new);

                    $video_path_new = public_path(VIDEO_PATH.$video_file_name_new);

                    Log::info("video_path_new".$video_path_new);

                    $command = "/usr/bin/ffmpeg -y -i ".$video_path ." ".$audio_urls.' -map 0:? '.$audio_maps.''.$audio_languages.' -c:v copy -c:a libmp3lame '.$video_path_new;

                    Log::info("Path ".$command);

                    shell_exec($command);
                    
                    // Log::info("ffmpeg LINK".print_r("/usr/bin/ffmpeg -i $video_path $audio_urls -map 0:? $audio_maps $audio_languages -c:v copy -c:a libmp3lame $video_path_new", true));

                    // $result = exec("/usr/bin/ffmpeg -i $video_path -i $audio_urls -map 0:? $audio_maps $audio_languages -c:v copy -c:a libmp3lame $video_path_new 2>&1", $output, $v);

                    // Log::info("result".print_r($output, true));

                    // Log::info("result".print_r($v, true));
                }

            }

        }  else {

            Log::info("Video not found..! - ".$this->admin_video_id);
        }
    }
}
