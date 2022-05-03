@extends('layouts.admin')

@section('title', tr('add_video'))

@section('content-header', tr('add_video'))

@section('styles')

    <link rel="stylesheet" href="{{asset('assets/css/wizard.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/jquery.jbswizard.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('admin-css/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/imgareaselect-default.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/jquery.awesome-cropper.css')}}">

    <link rel="stylesheet" href="{{asset('admin-css/plugins/iCheck/all.css')}}">

    <!-- <link rel="stylesheet" href="{{asset('assets/css/jquery.Jcrop.css')}}"> -->

    <!-- <link rel="stylesheet" href="{{asset('assets/css/style-example.css')}}"> -->

    <style type="text/css">
        
        .container-narrow {
          margin: 150px auto 50px auto;
          max-width: 728px;
        }

        canvas{
            width: 100%;
            height: auto;
        }
        span.select2-container{
            width:100% !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            margin-bottom: 10px;
            width: 30%;
        }

        .select2-container .select2-search--inline {
            border: 1px solid #d2d6df !important;
            width: 30%;
        }

    </style>

@endsection

@section('content')  

@if(envfile('QUEUE_CONNECTION') != 'redis') 

 <div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert">×</button>
        {{tr('warning_error_queue')}}
</div>
@endif

@if(checkSize())

 <div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert">×</button>
        {{tr('max_upload_size')}} <b>{{ini_get('upload_max_filesize')}}</b>&nbsp;&amp;&nbsp;{{tr('post_max_size')}} <b>{{ini_get('post_max_size')}}</b>
</div>
@endif


@if(Setting::get('ffmpeg_installed') == FFMPEG_NOT_INSTALLED) 

 <div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert">×</button>
        {{tr('ffmpeg_warning_notes')}}
</div>
@endif
    <div>
        <div class="main-content">

            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="display: none" id="error_popup">popup</button>

           <!-- popup -->

           <div class="modal fade error-popup" id="myModal" role="dialog">

               <div class="modal-dialog">

                   <div class="modal-content">

                       <div class="modal-body">

                           <div class="media">

                               <div class="media-left">

                                   <img src="{{asset('images/warning.jpg')}}" class="media-object" style="width:60px">

                               </div>

                               <div class="media-body">

                                   <h4 class="media-heading">Information</h4>

                                   <p id="error_messages_text"></p>

                               </div>

                           </div>

                           <div class="text-right">

                               <button type="button" class="btn btn-primary top" data-dismiss="modal">Okay</button>

                           </div>

                       </div>

                   </div>

               </div>

           </div>

            <div id="example">

                <div class="example-wizard panel panel-primary">
                    <div class="">
                        <!-- Example Wizard START -->
                        <div id="j-bs-wizard-example">
                            <ul class="nav nav-tabs nav-justified" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#first" role="tab" data-toggle="tab">{{tr('video_details')}}</a>
                                </li>
                                <li role="presentation">
                                    <a href="#second" role="tab" data-toggle="tab">{{tr('category')}}</a>
                                </li>
                                <li role="presentation">
                                    <a href="#third" role="tab" data-toggle="tab">{{tr('sub_category')}}</a>
                                </li>
                                <li role="presentation">
                                    <a href="#fourth" role="tab" data-toggle="tab">{{tr('upload_video_image')}}</a>
                                </li>
                            </ul>
                            <form method="post" enctype="multipart/form-data" id="upload_video_form" action="{{route('admin.videos.save')}}">   
                                @csrf
                                <div class="tab-content">
                                    <!-- tab1 -->
                                    <div role="tabpanel" class="tab-pane fade in active" id="first">
                                        <p class="note-sec">{{tr('note')}}: <span class="asterisk"><i class="fa fa-asterisk"></i></span> {{tr('mandatory_field_notes')}}
                                        @if($admin_video_details->id && $admin_video_details->id != 0)
                                            <input type="hidden" name="admin_video_id" id="admin_video_id" value="{{$admin_video_details->id}}">
                                        @endif
                                           <!--  <a href="#" data-toggle="tooltip" title="Hooray!" data-placement="right">Note</a> -->
                                        </p>
                                        <ul class="form-style-7">
                                            <li>
                                                <label for="title">{{tr('title')}} <span class="asterisk"><i class="fa fa-asterisk"></i></span> </label>
                                                <input type="text" name="title" maxlength="100" maxlength="255" value="{{old('title') ?:  $admin_video_details->title}}" id='title'>
                                            </li>
                                            <li>
                                                <label for="age">{{tr('age')}} <span class="asterisk"><i class="fa fa-asterisk"></i></span></label>
                                                <input type="text" name="age" maxlength="3" value="{{old('age') ?: $admin_video_details->age}}" id='age'>
                                            </li>
                                            <li>
                                                <label for="duration">{{tr('trailer_duration')}} <span class="asterisk"><i class="fa fa-asterisk"></i></span>(hh:mm:ss)</label>
                                                <input type="text" name="trailer_duration" maxlength="8" data-inputmask="'alias': 'hh:mm:ss'" data-mask value="{{old('trailer_duration') ?: $admin_video_details->trailer_duration}}" id="trailer_duration">
                                            </li>

                                            <li>
                                                <label for="duration">{{tr('main_video_duration')}} <span class="asterisk"><i class="fa fa-asterisk"></i></span>(hh:mm:ss)</label>
                                                <input type="text" name="duration" maxlength="8" data-inputmask="'alias': 'hh:mm:ss'" data-mask value="{{old('duration') ?: $admin_video_details->duration}}" id="duration">
                                            </li>
                                            <li>
                                                <label for="skip_intro_seconds">{{tr('skip_intro_seconds')}} ({{tr('in_seconds')}})</label>

                                                <input type="number" name="skip_intro_seconds" min="0" max="60" value="{{old('skip_intro_seconds') ?: $admin_video_details->skip_intro_seconds}}" id="skip_intro_seconds">
                                            </li>

                                            <li>
                                                <label for="skip_intro_start">{{tr('skip_intro_start')}} ({{tr('in_seconds')}})</label>

                                                <input type="number" name="skip_intro_start" min="0" max="60" value="{{old('skip_intro_start') ?: $admin_video_details->skip_intro_start}}" id="skip_intro_start">
                                            </li>
                                            <!-- <li>
                                                <label for="description">{{tr('description')}} <span class="asterisk"><i class="fa fa-asterisk"></i></span></label>

                                                <textarea name="description" rows="4" class="height-122" id="description">{{$admin_video_details->description}}</textarea>
                                            </li>-->

                                            <li class="height-54">
                                                <label for="reviews">{{tr('ratings')}} <span class="asterisk"><i class="fa fa-asterisk"></i></span></label>
                                                <div class="starRating">
                                                    <input id="rating5" type="radio" name="ratings" value="5" @if($admin_video_details->ratings == 5) checked @endif>
                                                    <label for="rating5">5</label>

                                                    <input id="rating4" type="radio" name="ratings" value="4" @if($admin_video_details->ratings == 4) checked @endif>
                                                    <label for="rating4">4</label>

                                                    <input id="rating3" type="radio" name="ratings" value="3" @if($admin_video_details->ratings == 3) checked @endif>
                                                    <label for="rating3">3</label>

                                                    <input id="rating2" type="radio" name="ratings" value="2" @if($admin_video_details->ratings == 2) checked @endif>
                                                    <label for="rating2">2</label>

                                                    <input id="rating1" type="radio" name="ratings" value="1" @if($admin_video_details->ratings == 1) checked @endif>
                                                    <label for="rating1">1</label>
                                                </div>
                                            </li>

                                            <li class="height-54">
                                                <label for="reviews">{{tr('publish_type')}} <span class="asterisk"><i class="fa fa-asterisk"></i></span></label>

                                                <div class="publish">
                                                    <div class="radio radio-primary radio-inline">
                                                        <input type="radio" id="now" value="{{PUBLISH_NOW}}" name="publish_type" onchange="checkPublishType(this.value)" {{($admin_video_details->id) ?  (($admin_video_details->status) ? "checked" : '' ) : 'checked' }} >
                                                        <label for="now"> {{tr('now')}} </label>
                                                    </div>

                                                    <div class="radio radio-primary radio-inline">
                                                        <input type="radio" id="later" value="{{PUBLISH_LATER}}" name="publish_type" onchange="checkPublishType(this.value)" {{($admin_video_details->id) ?  ((!$admin_video_details->status) ? "checked" : '' ) : '' }} >
                                                        <label for="later"> {{tr('later')}} </label>
                                                    </div>
                                                </div>
                                            </li>

                                            
                                            <li id="time_li" style="display: none;width: 98%;">
                                                <label for="time">{{tr('publish_time')}} <span class="asterisk"><i class="fa fa-asterisk"></i></span></label>
                                                <input type="text" name="publish_time" id="datepicker" readonly>
                                            </li> 
                                            
                                            <li>
                                                <label for="description">{{tr('description')}} <span class="asterisk"><i class="fa fa-asterisk"></i></span></label>
                                                <textarea name="description" rows="4">{{old('description') ?: $admin_video_details->description}}</textarea>
                                            </li>

                                            <li>
                                              <label for="details">{{tr('details')}} <span class="asterisk"><i class="fa fa-asterisk"></i></span></label>

                                                <textarea name="details" rows="4" id='details'>{{old('details') ?: $admin_video_details->details}}</textarea>

                                            </li> 

                                            <li style="width: 98%" class="cast-list">

                                                <label for="details">{{tr('cast_crews')}} (Optional)</label>

                                                <select id="cast_crews" name="cast_crew_ids[]" class="select2" multiple>

                                                    <option value="">{{tr('choose_cast_crews')}}</option>

                                                    @foreach($cast_crews as $cast_crew)
                                                        <option value="{{$cast_crew->id}}" @if(in_array($cast_crew->id, $video_cast_crews)) selected @endif>{{$cast_crew->name}}</option>
                                                    @endforeach
                                                </select>
                                            </li> 

                                        </ul>

                                        <div class="clearfix"></div>

                                        <br>

                                    </div>
                                    <!-- tab1 -->
                                    <!-- tab2 -->
                                    <div role="tabpanel" class="tab-pane fade" id="second">
                                        <div class="row">
                                            @foreach($categories as $category)
                                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                <a class="category" onclick="saveCategory({{$category->id}}, {{REQUEST_STEP_2}})" style="cursor: pointer;">
                                                    <div class="category-sec select-box category_list {{($category->id == $admin_video_details->category_id) ? 'active' : ''}}" id="category_{{$category->id}}" >
                                                        <div class="ribbon"><span><i class="fa fa-check"></i></span></div>
                                                        <img src="{{$category->picture}}" class="category-sec-img">
                                                    </div>
                                                    <h4 class="category-sec-title">{{$category->name}}</h4>
                                                </a>
                                            </div>
                                            @endforeach
                                            <input type="hidden" name="category_id" id="category_id"  value="{{$admin_video_details->category_id}}" />
                                        </div>
                                    </div>
                                    <!-- tab2 -->
                                    <!-- tab3-->
                                    <div role="tabpanel" class="tab-pane fade" id="third">
                                        <div class="row" id="sub_category">
                                                
                                            @if($admin_video_details->category_id)

                                            @foreach($sub_categories as $sub_category)
                                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                               <a class="category" onclick="saveSubCategory({{$sub_category->id}}, {{REQUEST_STEP_3}})" style="cursor: pointer;">
                                                    <div class="category-sec select-box sub_category_list {{($sub_category->id == $admin_video_details->sub_category_id) ? 'active' : ''}}" id="sub_category_{{$sub_category->id}}" >
                                                        <div class="ribbon"><span><i class="fa fa-check"></i></span></div>
                                                        <img src="{{$sub_category->picture}}" class="category-sec-img">
                                                    </div>
                                                    <h4 class="category-sec-title">{{$sub_category->name}}</h4>
                                                </a>
                                            </div>
                                            @endforeach 

                                            @endif
                                           
                                        </div>

                                         <input type="hidden" name="sub_category_id" id="sub_category_id" value="{{$admin_video_details->sub_category_id}}" />
                                    </div>
                                    <!-- tab3 -->
                                    <!-- tab4 -->
                                    <div role="tabpanel" class="tab-pane fade" id="fourth">

                                        <p class="note-sec">{{tr('note')}}: 
                                            <span class="asterisk"><i class="fa fa-asterisk"></i></span> {{tr('mandatory_field_notes')}}
                                        </p>
                                        <!-- select -->
                                        <ul class="form-style-7">
                                            <li id="genre_id">

                                                <label for="genre">{{tr('select_genre')}} 
                                                    <span class="asterisk"><i class="fa fa-asterisk"></i></span> 
                                                </label>
                                                <select class="form-control select2" id="genre" disabled name="genre_id">
                                                     <option value="">{{tr('select_genre')}}</option>
                                                </select>
                                            </li>

                                            <li style="border:0 !important;padding-left: 0 !important;padding-top: 17px;">
                                                
                                                <label class="label-cls">{{tr('video_type')}} <span class="asterisk"><i class="fa fa-asterisk"></i></span> </label>

                                                <div class="margin-videotype">
                                                    <div class="radio radio-primary radio-inline">
                                                        <input type="radio" id="video_upload_link" value="{{VIDEO_TYPE_UPLOAD}}" name="video_type" onchange="videoUploadType(this.value,0)" {{$admin_video_details->id ? ($admin_video_details->video_type == VIDEO_TYPE_UPLOAD ? 'checked': ''):'checked'}}>
                                                        <label for="video_upload_link"> {{tr('video_upload_link')}} </label>
                                                    </div>
                                                    <div class="radio radio-inline radio-primary" id="youtube">
                                                        <input type="radio" id="youtube_link" value="{{VIDEO_TYPE_YOUTUBE}}" name="video_type" onchange="videoUploadType(this.value,0)"  {{$admin_video_details->id ? ($admin_video_details->video_type == VIDEO_TYPE_YOUTUBE ? 'checked': ''):''}}>
                                                        <label for="youtube_link"> {{tr('youtube')}} </label>
                                                    </div>
                                                    <div class="radio radio-inline radio-primary" id="other_link">
                                                        <input type="radio" id="other_links" value="{{VIDEO_TYPE_OTHER}}" name="video_type" onchange="videoUploadType(this.value,0)" {{$admin_video_details->id ? ($admin_video_details->video_type == VIDEO_TYPE_OTHER ? 'checked': ''):''}}>
                                                        <label for="other_links"> {{tr('other_link')}} </label>
                                                    </div>
                                                    <div class="radio radio-inline radio-primary" id="vimeo_link">
                                                        <input type="radio" id="vimeo_links" value="{{VIDEO_TYPE_VIMEO}}" name="video_type" onchange="videoUploadType(this.value,0)" {{$admin_video_details->id ? ($admin_video_details->video_type == VIDEO_TYPE_VIMEO ? 'checked': ''):''}}>
                                                        <label for="vimeo_links"> {{tr('vimeo_link')}} </label>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                        <!-- radio and checkbox -->
                                        <div class="row manual_video_upload">
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <div class="mb-30">
                                                    <div>
                                                        <label class="label-cls">{{tr('compress_video')}}<span class="asterisk"><i class="fa fa-asterisk"></i></span> </label>
                                                    </div>
                                                    <div class="radio radio-primary radio-inline">
                                                        <input type="radio" id="COMPRESS_ENABLED" name="compress_video" value="{{COMPRESS_ENABLED}}" >
                                                        <label for="COMPRESS_ENABLED"> {{tr('yes')}} </label>
                                                    </div>
                                                    <div class="radio radio-inline radio-primary">
                                                        <input type="radio" id="COMPRESS_DISABLED" name="compress_video" value="{{COMPRESS_DISABLED}}" checked>
                                                        <label for="COMPRESS_DISABLED"> {{tr('no')}} </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <div class="mb-30">
                                                    <div>
                                                        <label class="label-cls">{{tr('video_upload_type')}} <span class="asterisk"><i class="fa fa-asterisk"></i></span> </label>
                                                    </div>
                                                    @if(check_s3_configure())
                                                    <div class="radio radio-primary radio-inline">
                                                        <input type="radio" id="s3" value="{{VIDEO_UPLOAD_TYPE_s3}}" name="video_upload_type">
                                                        <label for="s3">{{tr('s3')}}</label>
                                                    </div>
                                                    @endif
                                                    <div class="radio radio-inline radio-primary">
                                                        <input type="radio" id="direct" value="{{VIDEO_UPLOAD_TYPE_DIRECT}}" name="video_upload_type" checked>
                                                        <label for="direct">{{tr('direct')}}</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <div class="mb-30">
                                                    <div>
                                                        <label class="label-cls">{{tr('main_resize_video_resolutions')}} 
                                                            <span class="asterisk"><i class="fa fa-asterisk"></i></span>
                                                        </label>
                                                    </div>

                                                    @foreach(getVideoResolutions() as $key => $resolution)
                                                        <div class="checkbox checkbox-inline checkbox-primary" style="{{$key == 0 ? '' : ''}}">
                                                            <input type="checkbox" id="main_{{$resolution->value}}" value="{{$resolution->value}}" name="video_resolutions[]"  @if(in_array($resolution->value, $admin_video_details->trailer_video_resolutions)) checked @endif>
                                                            <label for="main_{{$resolution->value}}">{{$resolution->value}} </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <div class="mb-30">
                                                    <div>
                                                        <label class="label-cls">{{tr('trailer_resize_video_resolutions')}} <span class="asterisk"><i class="fa fa-asterisk"></i></span> </label>
                                                    </div>
                                                    @foreach(getVideoResolutions() as $i => $resolution)
                                                    <div class="checkbox checkbox-inline checkbox-primary" style="{{$i == 0 ? '' : 'padding-left:10px'}}">
                                                        <input type="checkbox" id="trailer_{{$resolution->value}}" value="{{$resolution->value}}" name="trailer_video_resolutions[]" @if(in_array($resolution->value, $admin_video_details->trailer_video_resolutions))  checked @endif>
                                                        <label for="trailer_{{$resolution->value}}">{{$resolution->value}} </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            
                                        </div>
                                        <!-- upload  video section -->

                                        <ul class="form-style-7 manual_video_upload">
                                            
                                            <!-- video -->
                                            
                                            <li>
                                                <label for="title">{{tr('video')}} <span class="asterisk"><i class="fa fa-asterisk"></i></span> </label>
                                                <p class="img-note mb-10">{{tr('video_validate')}}</p>
                                                <div class="">
                                                    <div class="">
                                                        <label class="">
                                                            <!-- <div class="btn btn-primary btn-sm">{{tr('browse')}}</div> -->
                                                            <input type="file" name="video" accept="video/mp4,video/x-matroska, .avi, .mov, .mkv" id="video" @if(!$admin_video_details->id) required @endif/>
                                                        </label>
                                                    </div>
                                                  <!--   <div id="file_input_text_div" class="mdl-textfield mdl-js-textfield textfield-demo">
                                                        <input class="file_input_text mdl-textfield__input" type="text" readonly id="file_input_text" />
                                                        <label class="mdl-textfield__label" for="file_input_text"></label>
                                                    </div> -->
                                                  </div>

                                                    @if($admin_video_details->id)
                                                        <a target="_blank" href="{{ route('admin.view.video' , ['id' => $admin_video_details->id]) }}" style="float: right">View</a>
                                                    @endif
                                            
                                            </li>

                                            <li>
                                                <label for="title">{{tr('trailer_video')}} <span class="asterisk"><i class="fa fa-asterisk"></i></span>  </label>

                                                <p class="img-note mb-10">{{tr('video_validate')}}</p>

                                                <div class="">
                                                    <div class="">
                                                        <label class="">
                                                            <!-- <div class="btn btn-primary btn-sm">{{tr('browse')}}</div> -->
                                                            <input type="file" name="trailer_video" accept="video/mp4,video/x-matroska, .avi, .mov, .mkv" id="trailer_video"/>
                                                        </label>
                                                    </div>
                                                   <!--  <div id="file_input_text_div" class="mdl-textfield mdl-js-textfield textfield-demo">
                                                        <input class="file_input_text mdl-textfield__input" type="text" readonly id="file_input_text" />
                                                        <label class="mdl-textfield__label" for="file_input_text"></label>
                                                    </div> -->
                                                  </div>
                                            
                                            </li>

                                            <li>

                                                <label for="title">{{tr('subtitle')}}</label>
                                                <p class="img-note mb-10">{{tr('subtitle_validate')}}</p>
                                                <div class="">
                                                    <div class="">
                                                        <label class="">
                                                           <!--  <div class="btn btn-primary btn-sm">{{tr('browse')}}</div> -->
                                                           <!--  <input id="video_subtitle" type="file" name="video_subtitle" onchange="checksrt(this, this.id)"/> -->

                                                            <input id="video_subtitle" type="file" name="video_subtitle" accept=".srt"/>
                                                        </label>
                                                    </div>
                                                   <!--  <div id="file_input_text_div" class="mdl-textfield mdl-js-textfield textfield-demo">
                                                        <input class="file_input_text mdl-textfield__input" type="text" readonly id="file_input_text" />
                                                        <label class="mdl-textfield__label" for="file_input_text"></label>
                                                    </div> -->
                                                  </div>
                                                
                                                @if($admin_video_details->id)
                                                    <a target="_blank" href="{{ route('admin.view.video' , ['id' => $admin_video_details->id]) }}" style="float: right">View</a>
                                                @endif

                                            </li>

                                            <li>

                                                <label for="title">{{tr('subtitle')}}</label>
                                                <p class="img-note mb-10">{{tr('subtitle_validate')}}</p>
                                                <div class="">
                                                    <div class="">
                                                        <label class="">
                                                            <!-- <div class="btn btn-primary btn-sm">{{tr('browse')}}</div> -->
                                                            <!-- <input id="trailer_subtitle" type="file" name="trailer_subtitle" onchange="checksrt(this, this.id)" id="trailer_subtitle"/> -->

                                                            <input id="trailer_subtitle" type="file" name="trailer_subtitle" accept=".srt"/>
                                                        </label>
                                                    </div>
                                                   <!--  <div id="file_input_text_div" class="mdl-textfield mdl-js-textfield textfield-demo">
                                                        <input class="file_input_text mdl-textfield__input" type="text" readonly id="file_input_text" />
                                                        <label class="mdl-textfield__label" for="file_input_text"></label>
                                                    </div> -->
                                                  </div>
                                            
                                            </li>

                                        </ul>

                                         <!-- upload  video section -->
                                        <ul class="form-style-7 others">
                                            <!-- video -->
                                            <li>
                                                <label for="trailer_video">
                                                    {{tr('trailer_video')}} 
                                                    <span class="asterisk"><i class="fa fa-asterisk"></i></span>
                                                </label>
                                                <span id="youtube_trailer_link" class="text-danger"> </span> 
                                                <input type="url" name="trailer_video" maxlength="256" id="other_trailer_video">
                                            </li>

                                            <li>
                                                <label for="video">{{tr('video')}} 
                                                    <span class="asterisk"><i class="fa fa-asterisk"></i></span>
                                                </label>
                                                <span id="youtube_video_link" class="text-danger"></span>
                                                <input type="url" name="video" maxlength="256" id="other_video">
                                            </li>

                                        </ul>

                                        <div class="clearfix"></div> 

                                        <div style="margin: 10px;">
                                            <div class="row">
                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                    <div class="checkbox checkbox-inline checkbox-primary">
                                                        <input type="checkbox" value="1" name="send_notification" id="send_notification">
                                                        <label for="send_notification">{{tr('send_notification')}}</label>
                                                    </div>
                                                </div>

                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                    <div class="checkbox checkbox-inline checkbox-primary">
                                                        <input type="checkbox" value="1" name="is_kids_video" @if($admin_video_details->is_kids_video == YES) checked @endif id="is_kids_video">
                                                        <label for="is_kids_video">{{tr('mark_as_kids_video')}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                        <!-- select image section -->
                                        <div>
                                            <div class="row">

                                                <div class="col-xs-12 col-sm-6 col-md-4 image-upload">

                                                    <label>{{tr('mobile_image')}}</label>

                                                    <input type="file" id="mobile_image" accept=".png, .jpg, .jpeg" name="mobile_image" placeholder="{{tr('mobile_image')}}" style="display:none" onchange="loadFile(this,'mobile_image_1')">

                                                    <div class="clearfix"></div>

                                                    <img src="{{$admin_video_details->mobile_image ?:  asset('images/default.png')}}" onclick="$('#mobile_image').click();return false;" id="mobile_image_1" style="width: 50%;height: 200px;">

                                                    <p class="img-note">{{tr('mobile_image_validate')}}</p>
                                                </div>

                                                <div class="col-xs-12 col-sm-6 col-md-4 image-upload">

                                                    <label>{{tr('default_image')}} <span class="asterisk"><i class="fa fa-asterisk"></i></span> </label>
                                                    

                                                    <input type="file" id="default_image" accept=".png, .jpg, .jpeg" name="default_image" placeholder="{{tr('default_image')}}" style="display:none" onchange="loadFile(this,'default_img')">

                                                    <img src="{{$admin_video_details->default_image ? $admin_video_details->default_image : asset('images/default.png')}}" onclick="$('#default_image').click();return false;" id="default_img">

                                                    <p class="img-note">{{tr('video_image_validate')}} {{tr('rectangle_image')}}</p> 
                                                </div>
                                                
                                            </div>

                                            <div class="progress">
                                                <div class="bar"></div >
                                                <div class="percent">0%</div >
                                            </div>


                                            <div class="clearfix"></div>
                                            
                                            @if(Setting::get('admin_delete_control') == 1) 

                                            <button disabled class="btn  btn-primary finish-btn" type="submit" id="finish_video"><i class="fa fa-arrow-right" aria-hidden="true"></i> &nbsp; Finish</button>

                                            @else
                                            <button class="btn  btn-primary finish-btn" type="submit" id="finish_video"><i class="fa fa-arrow-right" aria-hidden="true"></i> &nbsp; Finish</button>
                                            @endif
                                        </div>

                                        


                                    </div>  
                                    <!-- tab4 -->
                                </div>
                                <input type="hidden" name="timezone" value="{{ Auth::guard('admin')->user()->timezone }}">
                            </form>
                        </div>
                        <!-- Example Wizard END -->
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <div class="overlay">
        <div id="loading-img"></div>
    </div>

@endsection

@section('scripts')

    <script src="{{asset('admin-css/plugins/bootstrap-datetimepicker/js/moment.min.js')}}"></script> 

    <script src="{{asset('admin-css/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')}}"></script> 

    <script src="{{asset('admin-css/plugins/iCheck/icheck.min.js')}}"></script>

    <script src="{{asset('assets/js/jquery.jbswizard.min.js')}}"></script>

    <script src="{{asset('assets/js/jbswizard.js')}}"></script>

    <script src="{{asset('admin-css/plugins/jquery.form.js')}}"></script>

    <script src="{{asset('assets/js/jquery.awesome-cropper.js')}}"></script>

    <script src="{{asset('assets/js/jquery.imgareaselect.js')}}"></script>

    <script>
        $(document).ready(function () {
            // $('#default_image').awesomeCropper(         
            //     { width:2000, height: 1000, debug: true, default_image: 1}
            // );
            // $('#other_image1').awesomeCropper(         
            //     { width:2000, height: 1000, debug: true, other_image1:1 }
            // );
            // $('#other_image2').awesomeCropper(         
            //     { width:2000, height: 1000, debug: true, other_image2:1  }
            // );
        });
    </script> 

    <!-- <script src="{{asset('assets/js/jquery.Jcrop.js')}}"></script>

    <script src="{{asset('assets/js/jquery.SimpleCropper.js')}}"></script>

    <script>
         $('.cropme').simpleCropper();
    </script> -->

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>


    <script type="text/javascript">

        /** var fileInputTextDiv = document.getElementById('file_input_text_div');
        var fileInput = document.getElementById('file_input_file');
        var fileInputText = document.getElementById('file_input_text');

        fileInput.addEventListener('change', changeInputText);
        fileInput.addEventListener('change', changeState);

        function changeInputText() {
          var str = fileInput.value;
          var i;
          if (str.lastIndexOf('\\')) {
            i = str.lastIndexOf('\\') + 1;
          } else if (str.lastIndexOf('/')) {
            i = str.lastIndexOf('/') + 1;
          }
          fileInputText.value = str.slice(i, str.length);
        }

        function changeState() {
          if (fileInputText.value.length != 0) {
            if (!fileInputTextDiv.classList.contains("is-focused")) {
              fileInputTextDiv.classList.add('is-focused');
            }
          } else {
            if (fileInputTextDiv.classList.contains("is-focused")) {
              fileInputTextDiv.classList.remove('is-focused');
            }
          }
        } **/
    </script>

    <script src="{{asset('assets/js/upload-video.js')}}"></script>
    
    <script type="text/javascript">

        // $('.multipleSelect').select2();

        var banner_image = "{{$admin_video_details->is_banner}}";

        var cat_url = "{{ url('select/sub_category')}}";
        var step3 = "{{REQUEST_STEP_3}}";
        var sub_cat_url = "{{ url('select/genre')}}";
        var final = "{{REQUEST_STEP_FINAL}}";

        var video_id = "{{$admin_video_details->id}}";
        var genreId = "{{$admin_video_details->genre_id}}";

        var video_type = "{{$admin_video_details->video_type}}";

        var view_video_url = "{{url('admin/videos/view')}}?id=";

        var date = new Date();
        
        date.setDate(date.getDate());

        $('#datepicker').datetimepicker({
            // minDate: moment(),
            minDate:new Date(),
            startDate: date,
            autoclose:true,
            format:'dd-mm-yyyy hh:ii',
        });

        @if($admin_video_details->publish_time)

        $('#datepicker').val("{{date('d-m-Y H:i', strtotime($admin_video_details->publish_time))}}");

        @endif

        
        $('.manual_video_upload').show();
        
        $('.others').hide();

        $("#video_upload").change(function(){

            $(".manual_video_upload").show();
            
            $(".others").hide();
          
        });

        $("#youtube").change(function(){

            $(".others").show();

            $(".manual_video_upload").hide();

        });

        $("#other_link").change(function(){
 
            $(".others").show();

            $(".manual_video_upload").hide();
            
        });

        $("#vimeo_link").change(function(){
 
            $(".others").show();

            $(".manual_video_upload").hide();
            
        });
        
        function videoUploadType(value, autoload_status) {

            // On initialization, show others videos section

            $(".others").show();

            $("#other_video").attr('required', true);

            $("#other_trailer_video").attr('required', true);

             $("#other_trailer_video").keyup(function(){

                var url = $('#other_trailer_video').val();

                if(value == 2) {

                    if (url != undefined || url != '') {   

                        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
                        var match = url.match(regExp);

                        if (match && match[2].length == 11) {
                            $('#youtube_trailer_link').html('');
                            $('.finish-btn').prop('disabled', false);
                        } else {
                            // $('#youtube_trailer_link').html('Please enter valid youtube trailer link');
                            // $('.finish-btn').prop('disabled', true);
                        }
                    }
                }
            });

            $("#other_video").keyup(function(){

                var url = $('#other_video').val();
                
                if(value == 2) {

                    if (url != undefined || url != '') {   

                        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
                        var match = url.match(regExp);

                        if (match && match[2].length == 11) {
                            $('#youtube_video_link').html('');
                            $('.finish-btn').prop('disabled', false);
                        } else {
                            // $('#youtube_video_link').html('Please enter valid youtube link');
                            // $('.finish-btn').prop('disabled', true);

                        }
                    }
                }
            });

            if (autoload_status == 0) {

                $("#video").attr('required', true);

                $("#trailer_video").attr('required', true);   

            }

            $(".manual_video_upload").hide();

            $("#other_video").val("{{$admin_video_details->video}}");

            $("#other_trailer_video").val("{{$admin_video_details->trailer_video}}");
            
            if (value == "{{VIDEO_TYPE_UPLOAD}}") {

                $("#other_video").val("");

                $("#other_trailer_video").val("");

                $(".manual_video_upload").show();

                $(".others").hide();

                $("#other_video").attr('required', false);

                $("#other_trailer_video").attr('required', false);

                // If admin editing the video means remove the required fields for video & trailer video (If already in VIDEO_TYPE_UPLOAD)

                @if($admin_video_details->video_type == VIDEO_TYPE_UPLOAD)

                    $("#video").attr('required', false);

                    $("#trailer_video").attr('required', false);

                @endif

            }

            if ((value == "{{VIDEO_TYPE_OTHER}}" || value == "{{VIDEO_TYPE_YOUTUBE}}"|| value == "{{VIDEO_TYPE_VIMEO}}") && autoload_status == 0) {

                $("#other_video").val("");

                $("#other_trailer_video").val("");

                if(("{{$admin_video_details->video_type}}" == value) || ("{{$admin_video_details->video_type}}" == value)) {

                    $("#other_video").val("{{$admin_video_details->video}}");

                    $("#other_trailer_video").val("{{$admin_video_details->trailer_video}}");

                }

                $("#video").attr('required', false);

                $("#trailer_video").attr('required', false);   
            }

            if ((value == "{{VIDEO_TYPE_OTHER}}" || value == "{{VIDEO_TYPE_YOUTUBE}}" || value == "{{VIDEO_TYPE_VIMEO}}") && autoload_status == 0) {

                $("#other_video").val("");

                $("#other_trailer_video").val("");
            }
        
        }


       /* function saveVideo() {

            var formData = new FormData($('#upload_video_form')[0]);

            $.ajax({

                type : 'post',

                url : "{{route('admin.videos.save')}}",

                data : formData,

                contentType :false,

                processData:false,

                beforeSend : function(data) {

                    $("#finish_video").attr('disabled', true);

                },
                success : function(data) {

                    if (data.response.success) {

                        window.location.href= ""+data.response.data.id;

                    } else {

                        $("#error_messages_text").html(data.response.error_messages);

                        $("#error_popup").click();

                    }

                },

                error : function(data) {


                },

                complete : function(data) {

                    $("#finish_video").attr('disabled', false);

                }

            });

        }*/
        @if($admin_video_details->id && !$admin_video_details->status)

            checkPublishType("{{PUBLISH_LATER}}");

            $("#datepicker").val("{{date('d-m-Y H:i', strtotime($admin_video_details->publish_time))}}");

        @endif

        @if($admin_video_details->id)

        videoUploadType("{{$admin_video_details->video_type}}", 1);

        //saveCategory("{{$admin_video_details->category_id}}", "{{REQUEST_STEP_3}}");

        @endif

        function checkPublishType(val){
            $("#time_li").hide();
            //$("#datepicker").prop('required',false);
            $("#datepicker").val("");
            if(val == 2) {
                $("#time_li").show();
               // $("#datepicker").prop('required',true);
            }
        }

    </script>

    <script>
        $('form').submit(function () {
           window.onbeforeunload = null;
        });


        window.onbeforeunload = function() {
             return "Data will be lost if you leave the page, are you sure?";
        };

        loadGenre(genreId);

        window.setTimeout(function() {

            @if($admin_video_details->genre_id) 

                $("#genre select").val("{{$admin_video_details->genre_id}}");

            @endif

        }, 2000);


    </script>
   
 
@endsection


