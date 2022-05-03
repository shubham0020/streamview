@extends('layouts.admin')

@section('title', tr('home_page_settings'))

@section('content-header', tr('settings'))

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>{{ tr('home') }}</a></li>
    <li><i class="fa fa-gears"></i> {{ tr('settings') }}</li>
    <li class="active">{{ tr('home_page_settings') }}</li>
@endsection

@section('content')

<div class="row">

    <div class="col-xs-12">

        <div class="box box-warning">
        
            <div class="nav-tabs-custom">

                <div class="box-header table-header-theme">

                    <h3 class="box-title page_heading text-uppercase">{{tr('home_page_settings')}}</h3>

                </div>

                <div class="tab-content">
                   
                    <form action="{{ (Setting::get('admin_delete_control') == YES) ? '#' : route('admin.settings.save') }}" method="POST" enctype="multipart/form-data" role="form">
                        <div class="box-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <h3 class="settings-sub-header"><b>{{ tr('login_signup_pages') }}</b></h3>
                                    <hr>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group col-md-12">
                                            <label for="common_bg_image">{{ tr('common_bg_image') }}</label>
                                            <br>
                                            @if(Setting::get('common_bg_image'))
                                                <img class="settings-img-preview " src="{{ Setting::get('common_bg_image') }}" title="{{ Setting::get('sitename') }}">
                                            @endif
                                            <input type="file" id="common_bg_image" name="common_bg_image" accept="image/png, image/jpeg">
                                            <p class="help-block">{{ tr('image_note_help') }}</p>
                                        </div>    

                                    </div>

                                    <div class="col-md-6">

                                        <img class = "img img-thumbnail img-responsive" width = "100%"  src="{{asset('images/common-bg-demo.png')}}">

                                    </div>

                                </div>

                            </div>

                            <hr>

                            <div class="row">

                                <div class="col-md-12">
                                    <h3 class="settings-sub-header"><b>{{ tr('banner_section') }}</b></h3>
                                    <hr>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group col-md-12">
                                            <label for="home_banner_heading">{{ tr('banner_heading') }}</label>
                                            <input type="text" class="form-control" maxlength="80" name="home_banner_heading" value="{{  Setting::get('home_banner_heading')  }}" id="home_banner_heading" placeholder="{{ tr('banner_heading') }}">
                                        </div>
                                        
                                        
                                        <!-- <div class="form-group col-md-12"> // @todo not used
                                            <label for="banner_title">{{ tr('banner_title') }}</label>
                                            <input type="text" class="form-control" maxlength="80" name="home_banner_title" value="{{  Setting::get('home_banner_title')  }}" id="home_banner_title" placeholder="{{ tr('banner_title') }}">
                                        </div> -->

                                        <div class="form-group col-md-12">
                                            <label for="home_banner_description">{{ tr('banner_description') }}</label>
                                            <textarea class="form-control" id="home_banner_description" maxlength="150" name="home_banner_description">{{ Setting::get('home_banner_description') }}</textarea>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="home_page_bg_image">{{ tr('home_page_bg_image') }}</label>

                                            <br>

                                            @if(Setting::get('home_page_bg_image'))
                                                <img class="settings-img-preview " src="{{ Setting::get('home_page_bg_image') }}" title="{{ Setting::get('sitename') }}">
                                            @endif

                                            <input type="file" id="home_page_bg_image" name="home_page_bg_image" accept="image/png, image/jpeg">
                                            <p class="help-block">{{ tr('image_note_help') }}</p>
                                        </div>
                                        

                                    </div>

                                    <div class="col-md-6">

                                        <img class = "img img-thumbnail img-responsive" width = "100%"  src="{{asset('images/banner-section-demo.png')}}">

                                    </div>

                                </div>

                            </div>

                            <hr>

                            <!-- Home First section Start -->

                            <div class="row">

                                <div class="col-md-12">
                                    <h3 class="settings-sub-header"><b>{{ tr('home_first_section') }}</b></h3>
                                    <hr>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group col-md-12">
                                            <label for="home_section_1_title">{{ tr('title') }}</label>
                                            <input type="text" class="form-control" maxlength="80" name="home_section_1_title" value="{{  Setting::get('home_section_1_title')  }}" id="home_section_1_title" placeholder="{{ tr('home_section_1_title') }}">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="home_section_1_description">{{ tr('description') }}</label>
                                            <input type="text" class="form-control" maxlength="80" name="home_section_1_description" value="{{  Setting::get('home_section_1_description')  }}" id="home_section_1_description" placeholder="{{ tr('home_section_1_description') }}">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="home_section_1_video">{{ tr('home_section_1_video') }}</label>
                                            <br>
                                            <input type="file" id="home_section_1_video" name="home_section_1_video" accept="video/mp4,video/x-matroska, .avi, .mov, .mkv">
                                            <p class="help-block">{{ tr('video_note') }}</p>

                                            @if(Setting::get('home_section_1_video'))

                                                <video autoplay muted loop style="width: 100px; height: 75px;">
                                                    <source src="{{Setting::get('home_section_1_video')}}">
                                                </video>

                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        
                                        <img class = "img img-thumbnail img-responsive" width = "100%"  src="{{asset('images/first-section-demo.png')}}">

                                    </div>

                                </div>

                            </div>

                            <hr>

                            <!-- Home First section END -->


                            <!-- Home Second section Start -->

                            <div class="row">

                                <div class="col-md-12">
                                    <h3 class="settings-sub-header"><b>{{ tr('home_second_section') }}</b></h3>
                                    <hr>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group col-md-12">
                                            <label for="home_section_2_title">{{ tr('title') }}</label>
                                            
                                            <input type="text" class="form-control" maxlength="80" name="home_section_2_title" value="{{  Setting::get('home_section_2_title')  }}" id="home_section_2_title" placeholder="{{ tr('home_section_2_title') }}">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="home_section_2_description">{{ tr('description') }}</label>
                                            
                                            <input type="text" class="form-control" maxlength="80" name="home_section_2_description" value="{{  Setting::get('home_section_2_description')  }}" id="home_section_2_description" placeholder="{{ tr('home_section_2_description') }}">
                                        </div>

                                        <div class="form-group col-md-12">

                                            <label for="home_section_2_image">{{ tr('home_section_2_image') }}</label>

                                            <br>
                                            @if(Setting::get('home_section_2_image'))
                                                <img class="settings-img-preview " src="{{ Setting::get('home_section_2_image') }}" title="{{ Setting::get('sitename') }}">
                                            @endif

                                            <input type="file" id="home_section_2_image" name="home_section_2_image" accept="image/*">
                                            <p class="help-block">{{ tr('image_note_help') }}</p>

                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="home_section_2_image_title">{{ tr('home_section_2_image_title') }}</label>
                                            
                                            <input type="text" class="form-control" maxlength="80" name="home_section_2_image_title" value="{{  Setting::get('home_section_2_image_title')  }}" id="home_section_2_image_title" placeholder="{{ tr('home_section_2_image_title_placeholder') }}">
                                        </div>


                                        <div class="form-group col-md-12">

                                            <label for="home_section_2_mob_image">{{ tr('home_section_2_mob_image') }}</label>

                                            <br>
                                            @if(Setting::get('home_section_2_mob_image'))
                                                <img class="settings-img-preview " src="{{ Setting::get('home_section_2_mob_image') }}" title="{{ Setting::get('sitename') }}">
                                            @endif

                                            <input type="file" id="home_section_2_mob_image" name="home_section_2_mob_image" accept="image/png, image/jpeg">
                                            <p class="help-block">{{ tr('image_note_help') }}</p>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        
                                        <img class = "img img-thumbnail img-responsive" width = "100%"  src="{{asset('images/second-section-demo.png')}}">

                                    </div>

                                </div>

                            </div>

                            <hr>

                            <!-- Home Second section END -->

                            <!-- Home Third section Start -->

                            <div class="row">

                                <div class="col-md-12">
                                    <h3 class="settings-sub-header"><b>{{ tr('home_third_section') }}</b></h3>
                                    <hr>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group col-md-12">
                                            <label for="home_section_3_title">{{ tr('title') }}</label>
                                            <input type="text" class="form-control" maxlength="80" name="home_section_3_title" value="{{  Setting::get('home_section_3_title')  }}" id="home_section_3_title" placeholder="{{ tr('home_section_3_title') }}">
                                        </div>

                                        <div class="form-group col-md-12">
                                           
                                           <label for="home_section_3_description">{{ tr('description') }}</label>
                                            
                                            <input type="text" class="form-control" maxlength="80" name="home_section_3_description" value="{{  Setting::get('home_section_3_description')  }}" id="home_section_3_description" placeholder="{{ tr('home_section_3_description') }}">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="home_section_3_video">{{ tr('home_section_3_video') }}</label>
                                            <br>
                                            <input type="file" id="home_section_3_video" name="home_section_3_video" accept="video/mp4,video/x-matroska, .avi, .mov, .mkv">
                                            <p class="help-block">{{ tr('video_note') }}</p>

                                            @if(Setting::get('home_section_3_video'))

                                                <video autoplay muted loop style="width: 100px; height: 75px;">
                                                    <source src="{{Setting::get('home_section_3_video')}}">
                                                </video>

                                            @endif
                                        </div>

                                        <div class="form-group col-md-12">

                                            <label for="home_section_3_cover_image">{{ tr('home_section_3_cover_image') }}</label>
                                                <br>
                                            @if(Setting::get('home_section_3_cover_image'))
                                                <img class="settings-img-preview " src="{{ Setting::get('home_section_3_cover_image') }}" title="{{ Setting::get('sitename') }}">
                                            @endif

                                            <input type="file" id="home_section_3_cover_image" name="home_section_3_cover_image" accept="image/png, image/jpeg">
                                            <p class="help-block">{{ tr('image_note_help') }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        
                                        <img class = "img img-thumbnail img-responsive" width = "100%"  src="{{asset('images/third-section-demo.png')}}">

                                    </div>

                                </div>

                            </div>

                            <hr>

                            <!-- Home Third section END -->


                            <div class="box-footer">
                           
                                <button type="submit" class="btn btn-primary"  @if(Setting::get('admin_delete_control') == YES) disabled  @endif>{{ tr('submit') }}</button>
                           
                            </div>

                        </div>
                    
                    </form>
                
                </div>

            </div>

        </div>

    </div>

</div>

@endsection