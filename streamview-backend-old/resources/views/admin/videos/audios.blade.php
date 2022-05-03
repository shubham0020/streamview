@extends('layouts.admin')

@section('title', tr('videos'))

@section('content-header', tr('audios_and_subtitles'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.videos')}}"><i class="fa fa-support"></i> {{tr('videos')}}</a></li>
    <li class="active"><i class="fa fa-support"></i> {{tr('audios_and_subtitles')}}</li>
@endsection

@section('content')

<div class="row">

    <div class="col-md-12">

        <form class="repeater" action="{{ route('admin.videos.audios.save') }}" method="POST" enctype="multipart/form-data" role="form">

            @csrf
        
            <div class="box box-warning">

                <div class="box-header table-header-theme">

                    <div class='pull-left'>

                        <h3 class="box-title"><a href="{{ route('admin.view.video' , ['id' => $admin_video->id]) }}">{{$admin_video->title}}</a></b>
                        </h3>
                    </div>
                
                </div>

                <div class="tab-content" style="margin: 2rem ">

                    <div class="box-body"> 

                        <label for="title">{{tr('preview_video')}}</label>

                        <p class="img-note mb-10">{{tr('video_validate')}}</p>
                        <div class="">
                            <div class="">
                                <label class="">
                                    <input type="file" name="preview_video" accept="video/mp4,video/x-matroska, .avi, .mov, .mkv" id="video"/>
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="box-body"> 

                        <input type="hidden" name="video_id" value="{{$video_id}}">

                        <p>Note: The language Code should be <a href="https://en.wikipedia.org/wiki/List_of_ISO_639-2_codes" target="_blank">ISO 639-2</a> codes. 

                        <div data-repeater-list="group-a">
                            
                            @if($video_audios->count() > 0)

                                @foreach($video_audios as $key => $value)

                                    <div data-repeater-item>
                                        <div class="row">

                                            <input type="hidden" name="video_audios_id" value="{{$value->id}}">
                                            
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="language">{{ tr('language') }}</label>
                                                    <input type="text" class="form-control" name="language" value="{{$value->language}}" id="language" placeholder="{{ tr('language') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="language_code">{{ tr('language_code') }}</label>
                                                    <input type="text" class="form-control" name="language_code" value="{{$value->language_code}}" id="language_code" placeholder="{{ tr('language_code') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="audio">{{ tr('audio') }}</label>
                                                    <input type="file" name="audio" accept=".mp3" id="audio"/>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="subtitle">{{ tr('subtitle') }}</label>
                                                    <input id="subtitle" type="file" name="subtitle" accept=".srt"/>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <button data-repeater-delete type="button" class="btn btn-danger btn-sm icon-btn ml-2" >
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                
                                @endforeach

                            @else

    		                	<div data-repeater-item>

                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="language_code">{{ tr('language_code') }}</label>
                                                <input type="text" class="form-control" name="language_code" value="" id="language_code" placeholder="{{ tr('language_code') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="language">{{ tr('language') }}(Display Name)</label>
                                                <input type="text" class="form-control" name="language" value="" id="language" placeholder="{{ tr('language') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="audio">{{ tr('audio') }}</label>
                                                <input type="file" class="form-control" name="audio" accept=".mp3" id="audio"/>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="subtitle">{{ tr('subtitle') }}</label>
                                                <input id="subtitle" class="form-control" type="file" name="subtitle" accept=".srt"/>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <button data-repeater-delete type="button" class="btn btn-danger btn-sm icon-btn ml-2" >
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>

                                    </div>
    		                  	</div>
                            @endif
    	                <button data-repeater-create type="button" class="btn btn-info btn-sm icon-btn ml-2 mb-2">
    	                  <i class="fa fa-plus" aria-hidden="true"></i>
    	                </button>

                    </div>
    	                
    	        </div>

                <div class="box-footer">
                            
                    <button type="reset" class="btn btn-danger">{{ tr('cancel') }}</button>
                    
                    <button type="submit" class="btn btn-success pull-right"  @if(Setting::get('admin_delete_control') == YES) disabled @endif>{{ tr('submit') }}</button>                    
                
                </div>
            </div>
        </form>

    </div>

</div>


@endsection

@section('scripts')

<script src="{{asset('assets/js/jquery.repeater.min.js')}}"></script>
<script src="{{asset('assets/js/form-repeater.js')}}"></script>

@endsection