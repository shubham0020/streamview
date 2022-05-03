<ul class="admin-action btn btn-default">
	<li class="{{  $i < 5 ? 'dropdown' : 'dropup' }}">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
      {{ tr('action') }} <span class="caret"></span>
    </a>

    <ul class="dropdown-menu dropdown-menu-left">

    	@if ($admin_video_details->compress_status >= OVERALL_COMPRESS_COMPLETED)
      	<li role="presentation">
            @if(Setting::get('admin_delete_control'))
                <a role="button" href="javascript:;" class="btn disabled" style="text-align: left"><i class="fa fa-pencil text-blue"></i> {{ tr('edit') }}</a>
            @else
                <a role="menuitem" tabindex="-1" href="{{ route('admin.videos.edit' , ['admin_video_id' => $admin_video_details->video_id] ) }}"><i class="fa fa-pencil"></i> {{ tr('edit') }}</a>
            @endif
        </li>
        @endif
      	<li role="presentation"><a role="menuitem" tabindex="-1" target="_blank" href="{{ route('admin.view.video' , ['id' => $admin_video_details->video_id]) }}"><i class="fa fa-eye text-green"></i> {{ tr('view') }}</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.videos.audios' , ['admin_video_id'=>$admin_video_details->video_id]) }}"><i class="fa fa-file-audio-o text-green"></i> {{ tr('audios_and_subtitles') }}</a></li>
		  <li role="presentation"><a role="menuitem" tabindex="-1" target="_blank" href="{{ route('admin.videos.analytics' , ['admin_video_id'=>$admin_video_details->video_id]) }}"><i class="fa fa-bar-chart text-green"></i> {{ tr('analytics') }}</a></li>
      	<!-- <li role="presentation"><a role="menuitem" href="{{ route('admin.gif_generator' , array('video_id' => $admin_video_details->video_id)) }}">{{ tr('generate_gif_image') }}</a></li> -->

      @if ($admin_video_details->genre_id > 0 && $admin_video_details->is_approved && $admin_video_details->status)

      	<li role="presentation">
    		<a role="menuitem" tabindex="-1" role="menuitem" tabindex="-1" data-toggle="modal" data-target="#video_{{ $admin_video_details->video_id }}"><i class="fa fa-exchange text-maroon"></i> {{ tr('change_position') }}</a>
    	</li>

    	@endif

      	@if ($admin_video_details->compress_status >= OVERALL_COMPRESS_COMPLETED)

      		@if($admin_video_details->is_approved && $admin_video_details->status)

          	<li class="divider" role="presentation"></li>

      		<li role="presentation">

      			<a role="menuitem" tabindex="-1" data-toggle="modal" data-target="#banner_{{ $admin_video_details->video_id }}">

      				<i class="fa fa-mobile text-green"></i> {{ tr('banner_video') }}

      				@if($admin_video_details->is_banner == BANNER_VIDEO)

      				<span class="text-green"> <i class="fa fa-check-circle"></i></span>

      				@endif

      			</a>

      		</li>

      		@endif

      	@endif


      	<li role="presentation">

  			<a role="menuitem" tabindex="-1" href="{{route('admin.admin_videos.originals.status', ['admin_video_id' => $admin_video_details->video_id])}}" onclick="return confirm(&quot;{{tr('are_you_sure')}}&quot;)">

  				@if($admin_video_details->is_original_video == YES) 

  				<i class="fa fa-minus-circle text-red"></i>{{ tr('remove_from_original') }}

  				@else

  				<i class="fa fa-plus-circle text-green"></i> {{ tr('add_to_original') }}

  				@endif

  			</a>
  		</li>

  		@if($admin_video_details->is_video_eligible_for_download)

      		<li role="presentation">

      			<a role="menuitem" tabindex="-1" href="{{route('admin.admin_videos.download_status', ['admin_video_id' => $admin_video_details->video_id])}}" onclick="return confirm(&quot;{{tr('are_you_sure')}}&quot;)">

      				@if($admin_video_details->download_status == DISABLED_DOWNLOAD) 

      					<i class="fa fa-download text-green"></i> {{ tr('mark_as_download') }}

      				@else

      					<i class="fa fa-download text-red"></i> {{ tr('remove_from_download') }}

      				@endif

      			</a>
      		</li>

  		@endif

      	<li class="divider" role="presentation"></li>

      	@if(Setting::get('is_payper_view'))

      		<li role="presentation">
      			<a role="menuitem" tabindex="-1" data-toggle="modal" data-target="#{{ $admin_video_details->video_id }}">

      				<i class="fa fa-money text-green"></i> {{ tr('pay_per_view') }}

      				@if($admin_video_details->amount > 0)

      				<span class="text-green pull-right"><i class="fa fa-check-circle"></i></span>

      				@endif

      			</a>
      		</li>

      	@endif

      	<li class="divider" role="presentation"></li>


      	@if($admin_video_details->is_approved == VIDEO_APPROVED)

    		<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.videos.decline',['admin_video_id' => $admin_video_details->video_id]) }}"><i class="fa fa-ban text-red"></i> {{ tr('decline') }}</a></li>
    	@else

    		@if ($admin_video_details->compress_status < OVERALL_COMPRESS_COMPLETED)
    			<li role="presentation">
    				<a href="{{ route(
    				'admin.compress.status', ['id' =>  $admin_video_details->video_id]) }}" role="menuitem" tabindex="-1">
    					{{ tr('do_compression_in_background') }}
    				</a>
    			</li>
    		@else 
      			<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.videos.approve',['admin_video_id' => $admin_video_details->video_id] ) }}"><i class="fa fa-check text-green"></i>{{ tr('approve') }}</a></li>
      		@endif
      	@endif

      	@if ($admin_video_details->compress_status >= OVERALL_COMPRESS_COMPLETED)

          	<li role="presentation">
          		@if(Setting::get('admin_delete_control'))

              	 	<a role="button" href="javascript:;" class="btn disabled" style="text-align: left"><i class="fa fa-trash text-red"></i> {{ tr('delete') }}</a>

              	@else
          			<a role="menuitem" tabindex="-1" onclick="return confirm('Are you sure want to delete video? Remaining video positions will Rearrange')" href="{{ route('admin.delete.video' , ['admin_video_id' => $admin_video_details->video_id] ) }}"><i class="fa fa-trash text-red"></i> {{ tr('delete') }}</a>
          		@endif
          	
          	</li>
      	@endif

      	@if($admin_video_details->status == 0)
      		<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.video.publish-video',
      			['admin_video_id' => $admin_video_details->video_id] ) }}">{{ tr('publish') }}</a></li>
      	@endif
    </ul>
	</li>
</ul>