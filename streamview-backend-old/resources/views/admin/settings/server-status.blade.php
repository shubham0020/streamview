@extends('layouts.admin')

@section('title', tr('settings'))

@section('content-header', tr('settings'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li class="active"><i class="fa fa-money"></i> {{tr('settings')}}</li>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-8 col-md-offset-1">

            <div class="box box-danger">
                <div class="box-header with-border">
                    <h1 class="box-title text-uppercase">
                        <b>Project - server status</b>
                    </h1>

                    <p class="text-muted">To check the this page, the server user should have root access</p>
                
                </div>

                <div class="box-body">

                    <h4>Server OS details</h4>

                    <p class="text-muted">{{$data->ubuntu_version ?? "No data found"}}</p>

                    <hr>

                    <h4>Redis Server Version</h4>

                    <p class="text-muted">Server: {{$data->redis_server_version}} </p>

                    <p class="text-muted">Client: {{$data->redis_client_version}} </p>

                    <p class="text-muted">Status: {{$data->redis_server_status ?? "-"}} </p>

                    <hr>

                    <h4>Uploads folders</h4>

                    <p class="text-muted">Uploads Lists:cast_crews, gifs, images, settings, smil, sub_admins, subtitles, video-json, videos</p>

                    <p class="text-muted">Other Folders: public/default-json, /uploads/videos/original</p>

                    <hr>

                    <h4>Still video compressing?</h4>

                    <p class="text-muted">
                        <ul>
                            <li>Login to the server using SSH & follow the below stpes</li>

                            <li><code>cd streamview-backend</code></li>

                            <li><code>sudo chmod -R 777 storage/logs</code></li>

                            <li><code>php artisan queue:listen --timeout=0 --tries=2</code></li>

                            <li><code>sudo service redis-server restart</code></li>

                        </ul>
                    </p>

                    <hr>

                    <h4>Video Compressed, but not playing?</h4>

                    <p class="text-muted">
                        <ul>
                            <li>Login to the server using SSH & follow the below stpes</li>

                            <li><code>sudo /usr/local/sbin/nginx -s start</code></li>

                            <li><code>sudo snap install ffmpeg</code></li>

                            <li><code>sudo add-apt-repository ppa:jonathonf/ffmpeg-4</code></li>

                            <li><code>sudo apt update && sudo apt install ffmpeg libav-tools x264 x265</code></li>

                            <li><code>sudo apt-get install ffmpeg</code>
                            </li>
                        </ul>

                        Still not working? Contact Us.
                    </p>

                    <hr>

                    <h4>Frontend website not loading?</h4>

                    <p class="text-muted">
                        <ul>
                            <li>Login to the server using SSH & follow the below stpes</li>

                            <li><code>cd streamview-backend</code></li>
                            <li><code>sudo chmod -R 777 storage storage/logs bootstrap public/default-json</code></li>
                            <li>Logout from server</li>
                            <li>Open admin panel in the browser</li>
                            <li>Site Settings -> click "submit" option</li>
                            <li>Home Page Settings -> click "submit" option</li>
                        </ul>

                        Still not working? Contact Us.

                    </p>

                
                </div>
                  
            </div>
        </div>

    </div>


@endsection