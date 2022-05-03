@extends('layouts.admin')

@section('title', tr('settings'))

@section('content-header') 

{{ tr('settings') }} 

<a href="#" id="help-popover" class="btn btn-danger" style="font-size: 14px;font-weight: 600" title="">{{ tr('help_ques_mark') }}</a>

<div id="help-content" style="display: none">

    <ul class="popover-list">
        <li><b>{{ tr('paypal') }}- </b>{{ tr('minimum_accepted_amount_01') }}</li>
        <li><b>{{ tr('stripe') }}- </b>{{ tr('minimum_accepted_amount') }}<br> <a target="_blank" href="https://stripe.com/docs/currencies">{{ tr('check_references') }}</a></li>
    </ul>
    
</div>

@endsection

@section('styles')

<style>
    
/*  streamview tab */
div.streamview-tab-container{
  z-index: 10;
  background-color: #ffffff;
  padding: 0 !important;
  border-radius: 4px;
  -moz-border-radius: 4px;
  border:1px solid #ddd;
  margin-top: 20px;
  margin-left: 50px;
  -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
  box-shadow: 0 6px 12px rgba(0,0,0,.175);
  -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
  background-clip: padding-box;
  opacity: 0.97;
  filter: alpha(opacity=97);
}
div.streamview-tab-menu{
  padding-right: 0;
  padding-left: 0;
  padding-bottom: 0;
}
div.streamview-tab-menu div.list-group{
  margin-bottom: 0;
}
div.streamview-tab-menu div.list-group>a{
  margin-bottom: 0;
}
div.streamview-tab-menu div.list-group>a .glyphicon,
div.streamview-tab-menu div.list-group>a .fa {
  color: #1e5780;
}
div.streamview-tab-menu div.list-group>a:first-child{
  border-top-right-radius: 0;
  -moz-border-top-right-radius: 0;
}
div.streamview-tab-menu div.list-group>a:last-child{
  border-bottom-right-radius: 0;
  -moz-border-bottom-right-radius: 0;
}
div.streamview-tab-menu div.list-group>a.active,
div.streamview-tab-menu div.list-group>a.active .glyphicon,
div.streamview-tab-menu div.list-group>a.active .fa{
  background-color: #1e5780;
  background-image: #1e5780;
  color: #ffffff;
}
div.streamview-tab-menu div.list-group>a.active:after{
  content: '';
  position: absolute;
  left: 100%;
  top: 50%;
  margin-top: -13px;
  border-left: 0;
  border-bottom: 13px solid transparent;
  border-top: 13px solid transparent;
  border-left: 10px solid #1e5780;
}

div.streamview-tab-content{
  background-color: #ffffff;
  /* border: 1px solid #eeeeee; */
  padding-left: 20px;
  padding-top: 10px;
}

.box-body {
    padding: 0px;
}

div.streamview-tab div.streamview-tab-content:not(.active){
  display: none;
}

.sub-title {
    width: fit-content;
    color: #2c648c;
    font-size: 18px;
    /*border-bottom: 2px dashed #285a86;*/
    padding-bottom: 5px;
}

hr {
    margin-top: 15px;
    margin-bottom: 15px;
}

.list-group-item {

    cursor: pointer;

}

</style>
@endsection

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>{{ tr('home') }}</a></li>
    <li><i class="fa fa-gears"></i> {{ tr('settings') }}</li>
    <li class="active"> {{ tr('site_settings') }}</li>

@endsection

@section('content')

<div class="row">

    <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 streamview-tab-container">

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 streamview-tab-menu">
            
            <div class="list-group">
                
                <a class="list-group-item active text-left">{{ tr('site_settings') }}</a>

                <a class="list-group-item text-left">{{ tr('video_settings') }}</a>
                
                <a class="list-group-item text-left">{{ tr('revenue_settings') }}</a>

                <a class="list-group-item text-left">{{ tr('currency_settings') }}</a>

                <a class="list-group-item text-left">{{ tr('social_settings') }}</a>
                
                <a class="list-group-item text-left">{{ tr('payment_settings') }}</a>
                
                <a class="list-group-item text-left">{{ tr('email_settings') }}</a>
                
                <a class="list-group-item text-left">{{ tr('site_url_settings') }}</a>

                <a class="list-group-item text-left">{{ tr('mobile_settings') }}</a>

                <a class="list-group-item text-left">{{ tr('seo_settings') }}</a>

                <a class="list-group-item text-left">{{ tr('other_settings') }}</a>

            </div>

        </div>

        <div class="col-lg-10 col-md-9 col-sm-10 col-xs-10 streamview-tab">
            
            <!-- site settings begins -->            
            <div class="streamview-tab-content active">

                <form action="{{ (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.settings.save') }}" method="POST" enctype="multipart/form-data" role="form">

                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-12">
                                <h3 class="settings-sub-header"><b>{{ tr('site_settings') }}</b></h3>
                                <hr>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    
                                    <label for="sitename">{{ tr('site_name') }}</label>
                                    
                                    <input type="text" class="form-control" name="site_name" value="{{old('site_name') ?: Setting::get('site_name')}}" id="sitename" placeholder="Enter sitename">

                                </div>

                                <div class="form-group">
                                    
                                    <label for="sitename">{{ tr('tag_name') }}</label>
                                    
                                    <input type="text" class="form-control" name="tag_name" value="{{old('tag_name') ?: Setting::get('tag_name')}}" id="tag_name" placeholder="Enter tag name">

                                </div>

                                <div class="form-group">
                                   
                                    <label for="site_logo">{{ tr('site_logo') }}</label>

                                    <br>

                                    @if(Setting::get('site_logo'))
                                        <img class="settings-img-preview " src="{{ Setting::get('site_logo') }}" title="{{ Setting::get('sitename') }}">
                                    @endif

                                    <input type="file" id="site_logo" name="site_logo" accept="image/png, image/jpeg">
                                    <p class="help-block">{{ tr('image_note_help') }}</p>
                                </div>
                            </div>

                            <div class="col-lg-6">

                                <div class="form-group">

                                    <label for="streaming_url">{{ tr('ANGULAR_SITE_URL') }}</label>

                                    <input type="text" value="{{Setting::get('ANGULAR_SITE_URL')}}" class="form-control" name="ANGULAR_SITE_URL" id="ANGULAR_SITE_URL" placeholder="{{tr('frontend_url_message')}}">
                                </div> 

                                <div class="form-group">

                                    <label for="site_icon">{{ tr('site_icon') }}</label>

                                    <br>

                                    @if(Setting::get('site_icon'))
                                        <img class="settings-img-preview " src="{{ Setting::get('site_icon') }}" title="{{ Setting::get('sitename') }}">
                                    @endif
                                    <input type="file" id="site_icon" name="site_icon" accept="image/png, image/jpeg">
                                    <p class="help-block">{{ tr('image_note_help') }}</p>
                                </div>

                            </div>

                            <!-- <div class="col-lg-6">

                                <div class="form-group">

                                    <label for="watermark_logo">{{ tr('watermark_logo') }}</label>

                                    <br>

                                    @if(Setting::get('watermark_logo'))
                                        <img class="settings-img-preview " src="{{ Setting::get('watermark_logo') }}" title="{{ Setting::get('sitename') }}">
                                    @endif
                                    <input type="file" id="watermark_logo" name="watermark_logo" accept="image/*">
                                    <p class="help-block">{{ tr('watermark_logo_note') }}</p>
                                </div>

                            </div> -->

                        </div>

                    </div>

                    <!-- /.box-body -->

                    <div class="box-footer">

                        <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>

                        <button type="submit" class="btn btn-primary pull-right" @if(Setting::get('admin_delete_control') == YES ) disabled @endif>{{ tr('submit') }}</button>

                    </div>
                
                </form>

            </div>
            <!-- site settings ends -->

            <!-- Video settings begins -->
            <div class="streamview-tab-content">   

                <form action="{{ (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.video-settings.save') }}" method="POST" enctype="multipart/form-data" role="form">
                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-12">
                                <h3 class="settings-sub-header"><b>{{ tr('video_settings') }}</b></h3>
                                <hr>
                            </div>

                            <div class="col-md-12" style="display: none;">
                                <h5 class="sub-title" >{{ tr('player_configuration') }}</h5>
                            </div>

                            <div class="col-lg-12" style="display: none;">
                                <div class="form-group">

                                    <input type="radio" id="jw_player" value="{{JW_PLAYER}}" name="video_player_type" @if(Setting::get('video_player_type') == JW_PLAYER) checked @endif>
                                    <label for="jw_player"> {{tr('jw_player')}} </label>

                                    <input type="radio" id="free_player" value="{{FREE_PLAYER}}" name="video_player_type" @if(Setting::get('video_player_type') == FREE_PLAYER) checked @endif>
                                    <label for="free_player"> {{tr('free_player')}} </label>  
                               
                                </div>
                            </div>

                            <div class="col-lg-6" style="display: none;">
                                <div class="form-group">

                                    <label for="JWPLAYER_KEY">{{ tr('jwplayer_key_website') }}</label>

                                    <input type="text" value="{{old('JWPLAYER_KEY') ?:Setting::get('JWPLAYER_KEY')}}" class="form-control" name="JWPLAYER_KEY" id="JWPLAYER_KEY" placeholder="{{ tr('jwplayer_key_website') }}">
                                </div> 
                            </div>

                            <div class="col-lg-6" style="display: none;">
                                <div class="form-group">

                                    <label for="JWPLAYER_KEY_ANDRIOD">{{ tr('jwplayer_key_andriod') }}</label>

                                    <input type="text" value="{{old('JWPLAYER_KEY_ANDRIOD') ?:Setting::get('JWPLAYER_KEY_ANDRIOD')}}" class="form-control" name="JWPLAYER_KEY_ANDRIOD" id="JWPLAYER_KEY_ANDRIOD" placeholder="{{ tr('jwplayer_key_andriod') }}">
                                </div> 
                            </div>

                            <div class="col-lg-6" style="display: none;">
                                <div class="form-group">

                                    <label for="JWPLAYER_KEY_IOS">{{ tr('jwplayer_key_ios') }}</label>

                                    <input type="text" value="{{old('JWPLAYER_KEY_IOS') ?:Setting::get('JWPLAYER_KEY_IOS')}}" class="form-control" name="JWPLAYER_KEY_IOS" id="JWPLAYER_KEY_IOS" placeholder="{{ tr('jwplayer_key_ios') }}">
                                </div> 
                            </div>

                            <div class="col-md-12">
                                <hr>
                                <h5 class="sub-title" >{{ tr('streaming_configuration') }}</h5>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">

                                    <label for="socket_url">{{ tr('socket_url') }}</label>

                                    <p class="example-note">{{ tr('socket_url_note') }}</p>

                                    <input type="text" value="{{old('socket_url') ?:Setting::get('socket_url')}}" class="form-control" name="socket_url" id="socket_url" placeholder="{{ tr('socket_url') }}">
                                </div> 
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="HLS_STREAMING_URL">{{ tr('streaming_url') }}</label>
                                    
                                    <br>

                                    <p class="example-note">{{ tr('hls_settings_note') }}</p>

                                    <input type="text" value="{{old('HLS_STREAMING_URL') ?: Setting::get('HLS_STREAMING_URL') }}" class="form-control" name="HLS_STREAMING_URL" id="HLS_STREAMING_URL" placeholder="{{ tr('enter_streaming_url') }}">
                                </div> 
                            </div>

                            <div class="col-md-12">
                                <hr>
                                <h5 class="sub-title" >{{ tr('s3_settings') }}</h5>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="s3_key">{{ tr('S3_KEY') }}</label>
                                    <input type="text" class="form-control" name="S3_KEY" id="s3_key" placeholder="{{ tr('S3_KEY') }}" value="{{old('S3_KEY') ?: $result['S3_KEY'] }}">
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="s3_secret">{{ tr('S3_SECRET') }}</label>    
                                    <input type="text" class="form-control" name="S3_SECRET" id="s3_secret" placeholder="{{ tr('S3_SECRET') }}" value="{{ old('S3_SECRET') ?: $result['S3_SECRET'] }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="s3_region">{{ tr('S3_REGION') }}</label>    
                                    <input type="text" class="form-control" name="S3_REGION" id="s3_region" placeholder="{{ tr('S3_REGION') }}" value="{{ old('S3_REGION') ?: $result['S3_REGION'] }}">
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="s3_bucket">{{ tr('S3_BUCKET') }}</label>    
                                    <input type="text" class="form-control" name="S3_BUCKET" id="s3_bucket" placeholder="{{ tr('S3_BUCKET') }}" value="{{ old('S3_BUCKET') ?: $result['S3_BUCKET'] }}">
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="s3_ses_region">{{ tr('S3_SES_REGION') }}</label>    
                                    <input type="text" class="form-control" name="S3_SES_REGION" id="s3_ses_region" placeholder="{{ tr('S3_SES_REGION') }}" value="{{old('S3_SES_REGION') ?: $result['S3_SES_REGION'] }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <h5 class="sub-title" >{{ tr('promo_video_configuration') }}</h5>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ tr('is_promo_video_enabled') }}</label>
                                    <br>
                                    <label>
                                        <input required type="radio" name="is_promo_video_enabled" value="1" class="flat-red" @if(Setting::get('is_promo_video_enabled') == DEFAULT_TRUE) checked @endif>
                                        {{tr('yes')}}
                                    </label>

                                    <label>
                                        <input required type="radio" name="is_promo_video_enabled" class="flat-red"  value="0" @if(Setting::get('is_promo_video_enabled') == DEFAULT_FALSE) checked @endif>
                                        {{tr('no')}}
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="promo_video">{{ tr('promo_video') }}</label>
                                    <input type="file" id="promo_video" name="promo_video" accept="video/mp4">
                                </div>

                                @if(Setting::get('promo_video'))

                                    <video autoplay muted loop style="width: 150px; height: 100px;">
                                        <source src="{{Setting::get('promo_video')}}">
                                    </video>

                                @endif

                            </div>
                            
                            <div class="col-md-12">
                                <h5 class="sub-title" >{{ tr('watermark_settings') }}</h5>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ tr('is_watermark_logo_enabled') }}</label>
                                    <br>
                                    <label>
                                        <input required type="radio" name="is_watermark_logo_enabled" value="1" class="flat-red" @if(Setting::get('is_watermark_logo_enabled') == DEFAULT_TRUE) checked @endif>
                                        {{tr('yes')}}
                                    </label>

                                    <label>
                                        <input required type="radio" name="is_watermark_logo_enabled" class="flat-red"  value="0" @if(Setting::get('is_watermark_logo_enabled') == DEFAULT_FALSE) checked @endif>
                                        {{tr('no')}}
                                    </label>
                                </div>
                            </div>

                           

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="watermark_logo">{{tr('watermark_logo')}} *</label>
                                    <input type="file" class="form-control" id="watermark_logo" name="watermark_logo" accept="image/png" placeholder="{{tr('watermark_logo')}}">
                                </div>

                                @if(Setting::get('watermark_logo'))

                                    <img class="img img-thumbnail m-b-20" style="width: 40%" src="{{Setting::get('watermark_logo')}}" alt="{{Setting::get('site_name')}}"> 

                                @endif
                            
                            </div> 

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="currency_code">{{tr('watermark_position')}}</label>
                                    <select class="form-control select2" id="watermark_position" name="watermark_position" style="width: 365px;" required>
                                        <option value="">{{tr('select_position')}}</option>

                                        <option value="{{WATERMARK_TOP_LEFT}}" @if(Setting::get('watermark_position') == WATERMARK_TOP_LEFT) selected @endif> {{tr('top_left')}}</option>

                                        <option value="{{WATERMARK_TOP_RIGHT}}" @if(Setting::get('watermark_position') == WATERMARK_TOP_RIGHT) selected @endif>{{tr('top_right')}}</option>

                                        <option value="{{WATERMARK_BOTTOM_LEFT}}" @if(Setting::get('watermark_position') == WATERMARK_BOTTOM_LEFT) selected @endif>{{tr('bottom_left')}}</option>

                                        <option value="{{WATERMARK_BOTTOM_RIGHT}}" @if(Setting::get('watermark_position') == WATERMARK_BOTTOM_RIGHT) selected @endif>{{tr('bottom_right')}}</option>

                                        <option value="{{WATERMARK_CENTER}}" @if(Setting::get('watermark_position') == WATERMARK_CENTER) selected @endif>{{tr('center')}}</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                    </div>

                     <div class="box-footer">

                        <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>

                        <button type="submit" class="btn btn-primary pull-right" @if(Setting::get('admin_delete_control') == YES ) disabled @endif>{{ tr('submit') }}</button>
                        
                    </div>
                
                </form>
                
            </div>
            <!-- Video settings ends-->

            <!-- Revenue settings begins-->
            <div class="streamview-tab-content">
                <form action="{{ (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.settings.save') }}" method="POST" enctype="multipart/form-data" role="form">
                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-12">
                                <h3 class="settings-sub-header"><b>{{ tr('revenue_settings') }}</b></h3>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">

                                    <label for="video_viewer_count">{{ tr('video_viewer_count_size_label') }}</label>

                                    <br>

                                    <p class="example-note">{{ tr('video_viewer_count_size_label_note') }}</p>

                                    <input type="number" class="form-control" name="video_viewer_count" value="{{ old('video_viewer_count') ?: Setting::get('video_viewer_count') }}" id="video_viewer_count" min="0" max="100" maxlength="100" pattern="[0-9]{0,}" placeholder="{{ tr('video_viewer_count_size_label') }}" step="any">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="upload_max_size">{{ tr('amount_per_video') }}</label>
                                    
                                    <br>
                                    
                                    <p class="example-note">{{ tr('amount_per_video_note') }}</p>

                                    <input type="number" class="form-control" name="amount_per_video" value="{{ old('amount_per_video') ?: Setting::get('amount_per_video') }}" min="0" max="100" maxlength="100" pattern="[0-9]{0,}" id="amount_per_video" placeholder="{{ tr('amount_per_video') }}" step="any">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="admin_commission">{{ tr('admin_commission') }}</label>

                                    <input type="number" class="form-control" name="admin_commission" value="{{ old('admin_commission') ?:  Setting::get('admin_commission') }}" min="0" max="100" maxlength="100" pattern="[0-9]{0,}" id="admin_commission"  placeholder="{{ tr('admin_commission') }}">
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_commission">{{ tr('moderator_commission') }}</label>
                                    <input type="number" class="form-control" name="user_commission" value="{{ old('user_commission') ?: Setting::get('user_commission') }}" min="0" max="100" maxlength="100" pattern="[0-9]{0,}" id="user_commission" placeholder="{{ tr('moderator_commission') }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">

                                    <label>{{ tr('referral_code_earnings_label') }}</label>

                                    <br>

                                    <p class="example-note">{{ tr('referral_code_earnings_label_note') }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="referral_earnings">{{ tr('referral_earnings') }} ({{Setting::get('currency')}})</label>
                                    <input type="number" class="form-control" name="referral_earnings" value="{{ old('referral_earnings') ?: Setting::get('referral_earnings') }}" id="referral_earnings" min="0" maxlength="100" pattern="[0-9]{0,}" placeholder="{{ tr('referral_earnings') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="referrer_earnings">{{ tr('referrer_earnings') }}({{Setting::get('currency')}})</label>
                                    <input type="number" class="form-control" name="referrer_earnings" value="{{ old('referrer_earnings') ?: Setting::get('referrer_earnings') }}" min="0"maxlength="100" pattern="[0-9]{0,}" id="referrer_earnings" placeholder="{{ tr('referrer_earnings') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="referral_earnings_amount">{{ tr('referral_earnings_amount') }}({{Setting::get('currency')}})</label>
                                    <input type="number" class="form-control" name="referral_earnings_amount" value="{{ old('referral_earnings_amount') ?: Setting::get('referral_earnings_amount') }}" min="0"maxlength="100" pattern="[0-9]{0,}" id="referral_earnings_amount" placeholder="{{ tr('referral_earnings_amount') }}">
                                </div>
                            </div>

                            <div class="clearfix"></div>

                        </div>
                        
                    </div>

                     <div class="box-footer">

                        <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>

                        <button type="submit" class="btn btn-primary pull-right" @if(Setting::get('admin_delete_control') == YES ) disabled @endif>{{ tr('submit') }}</button>
                        
                    </div>

                </form>            
            </div>
            <!-- Revenue settings ends-->

             <!-- Currency settings begins-->
            <div class="streamview-tab-content">   

                <form action="{{ (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.settings.save') }}" method="POST" enctype="multipart/form-data" role="form">
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-12">
                                <h3 class="settings-sub-header"><b>{{ tr('currency_settings') }}</b></h3>
                                <hr>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="currency_code">{{ tr('select_currency') }} - {{ Setting::get('currency_code') }} ({{Setting::get('currency')}})</label>
                                    <select class="form-control select2" name="currency_code" id="currency_code" style="width: 365px;" required>
                                        <option value="">{{ tr('select_currency') }} </option>
                                            @foreach($currencies as  $currency)
                                                <option value="{{ $currency->currency_code }}" {{ (Setting::get('currency_code') == $currency->currency_code) ? 'selected' : Setting::get('currency_code') }}>{{ $currency->currency_code }} ({{ $currency->currency }})</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                            
                        <div class="box-footer">
                            <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>

                            <button type="submit" class="btn btn-primary pull-right" @if(Setting::get('admin_delete_control') == YES ) disabled @endif>{{ tr('submit') }}</button>
                        </div>
                </form>
            </div>
            <!-- Currency settings ends -->

            <!-- Social settings begins-->
            <div class="streamview-tab-content">   

                <form action="{{ (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.common-settings.save') }}" method="POST" enctype="multipart/form-data" role="form">
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-12">
                                <h3 class="settings-sub-header"><b>{{ tr('social_settings') }}</b></h3>
                                <hr>
                            </div>

                            <div class="col-md-12">
                                <h5 class="sub-title" >{{ tr('fb_settings') }}</h5>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="fb_client_id">{{ tr('FB_CLIENT_ID') }}</label>
                                    <input type="text" class="form-control" name="FB_CLIENT_ID" id="fb_client_id" placeholder="{{ tr('FB_CLIENT_ID') }}" value="{{ old('FB_CLIENT_ID') ?: $result['FB_CLIENT_ID'] }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="fb_client_secret">{{ tr('FB_CLIENT_SECRET') }}</label>    
                                    <input type="text" class="form-control" name="FB_CLIENT_SECRET" id="fb_client_secret" placeholder="{{ tr('FB_CLIENT_SECRET') }}" value="{{ old('FB_CLIENT_SECRET') ?: $result['FB_CLIENT_SECRET'] }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="fb_call_back">{{ tr('FB_CALL_BACK') }}</label>    
                                    <input type="text" class="form-control" name="FB_CALL_BACK" id="fb_call_back" placeholder="{{ tr('FB_CALL_BACK') }}" value="{{ old('FB_CALL_BACK') ?: $result['FB_CALL_BACK'] }}">
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="col-md-12">
                                <hr>
                                <h5 class="sub-title" >{{ tr('google_settings') }}</h5>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="google_client_id">{{ tr('GOOGLE_CLIENT_ID') }}</label>
                                    <input type="text" class="form-control" name="GOOGLE_CLIENT_ID" id="google_client_id" placeholder="{{ tr('GOOGLE_CLIENT_ID') }}" value="{{ old('GOOGLE_CLIENT_ID') ?: $result['GOOGLE_CLIENT_ID'] }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="google_client_secret">{{ tr('GOOGLE_CLIENT_SECRET') }}</label>    
                                    <input type="text" class="form-control" name="GOOGLE_CLIENT_SECRET" id="google_client_secret" placeholder="{{ tr('GOOGLE_CLIENT_SECRET') }}" value="{{ old('GOOGLE_CLIENT_SECRET') ?: $result['GOOGLE_CLIENT_SECRET'] }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="google_call_back">{{ tr('GOOGLE_CALL_BACK') }}</label>    
                                    <input type="text" class="form-control" name="GOOGLE_CALL_BACK" id="google_call_back" placeholder="{{ tr('GOOGLE_CALL_BACK') }}" value="{{old('GOOGLE_CALL_BACK') ?: $result['GOOGLE_CALL_BACK'] }}">
                                </div>
                            </div>
                            <div class='clearfix'></div>
                            <div class="col-md-12">
                                <hr>
                                <h5 class="sub-title" >{{ tr('fcm_settings') }}</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="FCM_SERVER_KEY">{{ tr('FCM_SERVER_KEY') }}</label>

                                    <input type="text" class="form-control" name="FCM_SERVER_KEY" id="FCM_SERVER_KEY"
                                    value="{{old('FCM_SERVER_KEY') ?: envfile('FCM_SERVER_KEY') }}" placeholder="{{ tr('FCM_SERVER_KEY') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="FCM_SENDER_ID">{{ tr('FCM_SENDER_ID') }}</label>

                                    <input type="text" class="form-control" name="FCM_SENDER_ID" id="FCM_SENDER_ID"
                                    value="{{old('FCM_SENDER_ID') ?: envfile('FCM_SENDER_ID') }}" placeholder="{{ tr('FCM_SENDER_ID') }}">
                                </div>
                            </div>

                        </div>
                    
                    </div>
                   
                     <div class="box-footer">

                        <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>

                        <button type="submit" class="btn btn-primary pull-right" @if(Setting::get('admin_delete_control') == YES ) disabled @endif>{{ tr('submit') }}</button>
                        
                    </div>

                </form>
            </div>
            <!-- Social settings ends -->

            <!-- Payment settings begins -->
            <div class="streamview-tab-content">    
                <form action="{{  (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.common-settings.save') }}" method="POST" enctype="multipart/form-data" role="form">
                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-12">
                                <h3 class="settings-sub-header"><b>{{ tr('payment_settings') }}</b></h3>
                                <hr>
                            </div>

                            <div class="col-md-12">
                                <h5 class="sub-title" >{{ tr('paypal_settings') }}</h5>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="paypal_id">{{ tr('PAYPAL_ID') }}</label>
                                    <input type="text" class="form-control" name="PAYPAL_ID" id="paypal_id" placeholder="{{ tr('PAYPAL_ID') }}" value="{{old('PAYPAL_ID') ?: $result['PAYPAL_ID'] }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="paypal_secret">{{ tr('PAYPAL_SECRET') }}</label>    
                                    <input type="text" class="form-control" name="PAYPAL_SECRET" id="paypal_secret" placeholder="{{ tr('PAYPAL_SECRET') }}" value="{{old('PAYPAL_SECRET') ?: $result['PAYPAL_SECRET'] }}">
                                </div>
                            </div>
                            <!-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="paypal_mode">{{ tr('PAYPAL_MODE') }}</label>    
                                    <input type="text" class="form-control" name="PAYPAL_MODE" id="paypal_mode" placeholder="{{ tr('PAYPAL_MODE') }}" value="{{old('PAYPAL_MODE') ?: $result['PAYPAL_MODE'] }}">
                                </div>
                            </div> -->

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="PAYPAL_URL_MODE">{{tr('PAYPAL_URL_MODE')}}</label> 

                                    <div class="clearfix"></div>
                                    
                                    <input type="radio" name="PAYPAL_MODE" value="{{PRODUCTION}}" id="paypal_live" @if($result['PAYPAL_MODE'] == PRODUCTION ) checked @endif>{{ tr('paypal_live') }}

                                    <input type="radio" name="PAYPAL_MODE" value="{{SANDBOX}}" id="paypal_sandbox" @if($result['PAYPAL_MODE'] == SANDBOX ) checked @endif>{{ tr('paypal_sandbox') }}
                                    
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div class="col-md-12">
                                <hr>
                                <h5 class="sub-title" >{{ tr('stripe_settings') }}</h5>
                            </div>

                             <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="stripe_publishable_key">{{ tr('stripe_publishable_key') }}</label>
                                    <input type="text" class="form-control" name="stripe_publishable_key" id="stripe_publishable_key" placeholder="{{ tr('stripe_publishable_key') }}" value="{{old('stripe_publishable_key') ?: Setting::get('stripe_publishable_key') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="stripe_secret_key">{{ tr('stripe_secret_key') }}</label>
                                    <input type="text" class="form-control" name="stripe_secret_key" id="stripe_secret_key" placeholder="{{ tr('stripe_secret_key') }}" value="{{old('stripe_secret_key') ?: Setting::get('stripe_secret_key') }}">
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="box-footer">

                        <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>

                        <button type="submit" class="btn btn-primary pull-right" @if(Setting::get('admin_delete_control') == YES ) disabled @endif>{{ tr('submit') }}</button>
                        
                    </div>

                </form>
            
            </div>
            <!-- Payment Settings ends -->

            <!-- Email settings begins-->
            <div class="streamview-tab-content">
                
                <form action="{{ route('admin.common-settings.save') }}" method="POST" enctype="multipart/form-data" role="form">
                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-12">
                                <h3 class="settings-sub-header"><b>{{ tr('email_settings') }}</b></h3>
                                <hr>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="MAIL_MAILER">{{ tr('MAIL_MAILER') }}</label>
                                    <input type="text" value="{{old('MAIL_MAILER') ?: $result['MAIL_MAILER'] }}" class="form-control" name="MAIL_MAILER" id="MAIL_MAILER" placeholder="Enter {{ tr('MAIL_MAILER') }}">
                                </div>

                                <div class="form-group">
                                    <label for="MAIL_HOST">{{ tr('MAIL_HOST') }}</label>
                                    <input type="text" class="form-control" value="{{old('MAIL_HOST') ?: $result['MAIL_HOST'] }}" name="MAIL_HOST" id="MAIL_HOST" placeholder="{{ tr('MAIL_HOST') }}">
                                </div>

                                <div class="form-group">
                                    <label for="MAIL_PORT">{{ tr('MAIL_PORT') }}</label>
                                    <input type="text" class="form-control" value="{{old('MAIL_PORT') ?: $result['MAIL_PORT'] }}" name="MAIL_PORT" id="MAIL_PORT" placeholder="{{ tr('MAIL_PORT') }}">
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="MAIL_USERNAME">{{ tr('MAIL_USERNAME') }}</label>
                                    <input type="text" class="form-control" value="{{old('MAIL_USERNAME') ?: $result['MAIL_USERNAME']  }}" name="MAIL_USERNAME" id="MAIL_USERNAME" placeholder="{{ tr('MAIL_USERNAME') }}">
                                </div>

                                <div class="form-group">
                                    <label for="MAIL_PASSWORD">{{ tr('MAIL_PASSWORD') }}</label>
                                    <input type="password" class="form-control" name="MAIL_PASSWORD" id="MAIL_PASSWORD" placeholder="{{ tr('MAIL_PASSWORD') }}" value="{{ old('MAIL_PASSWORD') ?: $result['MAIL_PASSWORD'] }}">
                                </div>

                                <div class="form-group">
                                    <label for="MAIL_ENCRYPTION">{{ tr('MAIL_ENCRYPTION') }}</label>
                                    <input type="text" class="form-control" value="{{ old('MAIL_ENCRYPTION') ?: $result['MAIL_ENCRYPTION']  }}" name="MAIL_ENCRYPTION" id="MAIL_ENCRYPTION" placeholder="{{ tr('MAIL_ENCRYPTION') }}">
                                </div>

                            </div>

                            <div class="clearfix"></div>

                            @if($result['MAIL_MAILER'] == 'mailgun')

                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="MAILGUN_DOMAIN">{{ tr('MAILGUN_DOMAIN') }}</label>
                                    <input type="text" class="form-control" value="{{ old('MAILGUN_DOMAIN') ?: $result['MAILGUN_DOMAIN']  }}" name="MAILGUN_DOMAIN" id="MAILGUN_DOMAIN" placeholder="{{ tr('MAILGUN_DOMAIN') }}">
                                </div>

                                <div class="form-group">
                                    <label for="MAILGUN_SECRET">{{ tr('MAILGUN_SECRET') }}</label>
                                    <input type="text" class="form-control" name="MAILGUN_SECRET" id="MAILGUN_SECRET" placeholder="{{ tr('MAILGUN_SECRET') }}" value="{{old('MAILGUN_SECRET') ?: $result['MAILGUN_SECRET'] }}">
                                </div>

                            </div>

                            @endif

                        </div>

                    </div>

                     <div class="box-footer">
                        
                        <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>
                        
                        <button type="submit" class="btn btn-primary pull-right" @if(Setting::get('admin_delete_control') == YES ) disabled  @endif>{{ tr('submit') }}</button>                       
                    </div>

                </form>
            </div>
            <!-- Email Settings ends -->

            <!-- Company Settings begins-->
            <div class="streamview-tab-content">
               
                <form action="{{ (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.settings.save') }}" method="POST" enctype="multipart/form-data" role="form">
                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-12">
                                <h3 class="settings-sub-header"><b>{{ tr('site_url_settings') }}</b></h3>
                                <hr>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="facebook_link">{{ tr('facebook_link') }}</label>

                                    <input type="url" class="form-control" name="facebook_link" id="facebook_link"
                                    value="{{old('facebook_link') ?: Setting::get('facebook_link') }}" placeholder="{{ tr('facebook_link') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="linkedin_link">{{ tr('linkedin_link') }}</label>

                                    <input type="url" class="form-control" name="linkedin_link" value="{{old('linkedin_link') ?: Setting::get('linkedin_link')}}" id="linkedin_link" placeholder="{{ tr('linkedin_link') }}">

                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="form-group">

                                    <label for="twitter_link">{{ tr('twitter_link') }}</label>

                                    <input type="url" class="form-control" name="twitter_link" value="{{old('twitter_link') ?: Setting::get('twitter_link')}}" id="twitter_link" placeholder="{{ tr('twitter_link') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="google_plus_link">{{ tr('google_plus_link') }}</label>
                                    <input type="url" class="form-control" name="google_plus_link" value="{{old('google_plus_link') ?: Setting::get('google_plus_link')}}" id="google_plus_link" placeholder="{{ tr('google_plus_link') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pinterest_link">{{ tr('pinterest_link') }}</label>
                                    <input type="url" class="form-control" name="pinterest_link" value="{{old('pinterest_link') ?: Setting::get('pinterest_link')}}" id="pinterest_link" placeholder="{{ tr('pinterest_link') }}">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            
                        </div>
                    
                    </div>
                    
                    <div class="box-footer">
                        <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>
                        
                        <button type="submit" class="btn btn-primary pull-right" @if(Setting::get('admin_delete_control') == YES ) disabled  @endif>{{ tr('submit') }}</button>                       
                    </div>

                </form>
            </div>
            <!-- Company Settings ends -->

            <!-- APP Url Settings begins-->
            <div class="streamview-tab-content">
                
                <form action="{{  (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.settings.save') }}" method="POST" enctype="multipart/form-data" role="form">
                    <div class="box-body">
                            
                        <div class="row">

                            <div class="col-md-12">
                                <h3 class="settings-sub-header"><b>{{ tr('mobile_settings') }}</b></h3>
                                <hr>
                            </div>

                            <div class="col-md-12">
                                <h5 class="sub-title" >{{ tr('app_url_settings') }}</h5>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="appstore">{{ tr('appstore') }}</label>
                                    <input type="url" class="form-control" name="appstore" id="appstore"
                                    value="{{old('appstore') ?: Setting::get('appstore') }}" placeholder="{{ tr('appstore') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="playstore">{{ tr('playstore') }}</label>
                                    <input type="url" class="form-control" name="playstore" value="{{ old('playstore') ?: Setting::get('playstore')   }}" id="playstore" placeholder="{{ tr('playstore') }}">
                                </div>
                            </div>
                            
                        </div>

                    </div>

                    <div class="box-footer">
                        <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>
                        
                        <button type="submit" class="btn btn-primary pull-right" @if(Setting::get('admin_delete_control') == YES ) disabled  @endif>{{ tr('submit') }}</button>                       
                    </div>

                </form>

            </div>
            <!-- APP Url Settings ends -->

            <!-- SEO Settings begins-->
            <div class="streamview-tab-content">

                <form action="{{  (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.settings.save') }}" method="POST" enctype="multipart/form-data" role="form">
                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-12">
                                <h3 class="settings-sub-header"><b>{{ tr('seo_settings') }}</b></h3>
                                <hr>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{  tr('meta_title')  }}</label>
                                     <input type="text" name="meta_title" value="{{  old('meta_title') ?: Setting::get('meta_title', '')   }}" required class="form-control" placeholder="{{ tr('meta_title') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('meta_author') }}</label>
                                    <input type="text" class="form-control" value="{{ old('meta_author') ?: Setting::get('meta_author') }}" name="meta_author" id="meta_author" placeholder="{{ tr('meta_author') }}">
                                </div>                             
                            </div>

                            <div class="clearfix"></div>

                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="meta_keywords">{{ tr('meta_keywords') }}</label>
                                    <textarea class="form-control" id="meta_keywords" name="meta_keywords">{{ old('meta_keywords') ?: Setting::get('meta_keywords') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="meta_description">{{ tr('meta_description') }}</label>
                                    <textarea class="form-control" id="meta_description" name="meta_description">{{ old('meta_description') ?: Setting::get('meta_description') }}</textarea>
                                </div>  

                            </div>

                            <div class="clearfix"></div>
                            
                        </div>
                    
                    </div>

                    <div class="box-footer">
                        <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>
                        
                        <button type="submit" class="btn btn-primary pull-right" @if(Setting::get('admin_delete_control') == YES ) disabled  @endif>{{ tr('submit') }}</button>                       
                    </div>

                </form>

            </div>
            <!-- SEO Settings ends -->

            <!-- OTHER Settings begins -->
            <div class="streamview-tab-content">
                
                <form action="{{ (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.settings.save') }}" method="POST" enctype="multipart/form-data" r  ole="form">
                    <div class="box-body"> 
                        <div class="row"> 

                            <div class="col-md-12">

                                <h3 class="settings-sub-header"><b>{{ tr('other_settings') }}</b></h3>

                                <hr>

                            </div>

                            <div class="col-lg-12">

                                <div class="form-group">
                                    <label for="google_analytics">{{ tr('google_analytics') }}</label>
                                    <textarea class="form-control" id="google_analytics" name="google_analytics">{{ old('google_analytics') ?: Setting::get('google_analytics') }}</textarea>
                                </div>

                            </div> 

                            <div class="col-lg-12">

                                <div class="form-group">
                                    <label for="header_scripts">{{ tr('header_scripts') }}</label>
                                    <textarea class="form-control" id="header_scripts" name="header_scripts">{{ old('header_scripts') ?: Setting::get('header_scripts') }}</textarea>
                                </div>

                            </div> 

                            <div class="col-lg-12">

                                <div class="form-group">
                                    <label for="body_scripts">{{ tr('body_scripts') }}</label>
                                    <textarea class="form-control" id="body_scripts" name="body_scripts">{{ old('body_scripts') ?: Setting::get('body_scripts') }}</textarea>
                                </div>
                            </div> 

                            <div class="col-lg-6">

                                <div class="form-group">

                                    <label for="email_notification">{{ tr('email_notification') }}</label>
                                    <div class="clearfix"></div>

                                    <input type="checkbox" name="email_notification" value="1" id="email_notification" @if(Setting::get('email_notification')) checked @endif>{{ tr('enable_email_notification_to_user') }}
                                </div>

                            </div>
                            
                            @if(Setting::get('admin_language_control') == 0)

                            <div class="col-lg-4">

                                <div class="form-group">
                                    <label for="default_lang">{{ tr('default_lang') }}</label>

                                    <select class="form-control select2" name="default_lang" id="default_lang" required>

                                        <option value="">{{ tr('language') }}</option>
                                            @foreach($languages as $h => $language)
                                                <option value="{{ $language->folder_name }}" {{ (Setting::get('default_lang') == $language->folder_name) ? 'selected' : Setting::get('default_lang') }}>{{ $language->language }}({{ $language->folder_name }})</option>
                                            @endforeach
                                        
                                        </select>
                                </div> 

                            </div> 

                            @endif

                        </div>
                    </div>
                          <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>
                        
                        <button type="submit" class="btn btn-primary pull-right" @if(Setting::get('admin_delete_control') == YES ) disabled  @endif>{{ tr('submit') }}</button>                       
                    </div>

                </form>

            </div>

        </div>
    
    </div>
    
    <div class="clearfix"></div>

</div>

@endsection

@section('scripts')

<script type="text/javascript">
    
    $(document).ready(function() {
        $("div.streamview-tab-menu>div.list-group>a").click(function(e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            $("div.streamview-tab>div.streamview-tab-content").removeClass("active");
            $("div.streamview-tab>div.streamview-tab-content").eq(index).addClass("active");
        });
    });

    $(document).ready(function(){

     var setting_success_msg = "{{Session::get('flash_success')}}";

        if(setting_success_msg){

            "{{Session::forget('flash_success')}}";
        }
  });
</script>
@endsection