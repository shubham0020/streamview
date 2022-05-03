@extends('layouts.admin')

@section('title', isset($_GET['banner']) ? tr('banner_videos') : (isset($_GET['originals']) ? tr('original_videos') : (isset($_GET['downloadable'])?tr('downloadable_videos'): tr('view_videos'))))


@section('content-header')

@if(Request::get('downloaded'))

{{ tr('downloaded_videos') }}

@else

{{ tr('videos') }}

@endif
@endsection


@section('breadcrumb')

    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>{{ tr('home') }}</a></li>
    <li><a href="#"><i class="fa fa-video-camera"></i>{{ tr('videos') }}</a></li>


    <li class="active">@yield('title')</li>
    
@endsection

@section('content')

    @if($category || $sub_category || $genre || isset($moderator_details))

	    <div class="row">

	    	<div class="col-xs-12">

	    		@if($category)
	    			<p class="text-uppercase">{{ tr('category') }} - {{ $category ? $category->name : "-"  }}</p>
	    		@endif

	    		@if($sub_category)
	    			<p class="text-uppercase">{{ tr('sub_category') }} - {{ $sub_category ? $sub_category->name : "-"  }}</p>
	    		@endif

	    		@if($genre)
	    			<p class="text-uppercase">{{ tr('genre') }} - {{ $genre ? $genre->name : "-" }}</p>
	    		@endif

	    		@if(isset($moderator_details))
	    			@if($moderator_details)<p class="text-uppercase">{{ tr('moderator') }} - <a class="badge badge-primary" href="{{route('admin.moderators.view',['moderator_id'=> $moderator_details->id])}}">{{ $moderator_details->name }}</a></p>@endif
	    		@endif

	    	</div>

	    </div>

    @endif

	<div class="row">

        <div class="col-xs-12">

          <div class="box box-warning">

          	<div class="box-header table-header-theme">

                <b style="font-size:18px;">@yield('title')</b>

                <a href="{{ route('admin.videos.create') }}" class="btn btn-default pull-right">{{ tr('add_video') }}</a>

                 <!-- EXPORT OPTION START -->

                @if(count($admin_videos) > 0 )
                
	                <ul class="admin-action btn btn-default pull-right" style="margin-right: 20px">
	                 	
						<li class="dropdown">
			                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			                  {{ tr('export') }} <span class="caret"></span>
			                </a>
			                <ul class="dropdown-menu">
			                  	<li role="presentation">
			                  		<a role="menuitem" tabindex="-1" href="{{ route('admin.videos.export' , 
			                  		['format' => 'xlsx',

			                  		'status'=>Request::get('status'),

			                  		'video_type'=>Request::get('video_type'),

			                  		'search_key'=>Request::get('search_key'),

			                  		'downloadable'=>Request::get('downloadable'), 

			                  		'originals'=>Request::get('originals'), 

			                  		'category_id'=>Request::get('category_id'),

			                  		'sub_category_id'=>Request::get('sub_category_id')

			                  		]) }}">
			                  			<span class="text-red"><b>{{ tr('excel_sheet') }}</b></span>
			                  		</a>
			                  	</li>

			                  	<li role="presentation">
			                  		<a role="menuitem" tabindex="-1" href="{{ route('admin.videos.export' , 
			                  		['format' => 'csv',

			                  		'status'=>Request::get('status'),

			                  		'video_type'=>Request::get('video_type'),

			                  		'search_key'=>Request::get('search_key'),

			                  		'downloadable'=>Request::get('downloadable'), 

			                  		'originals'=>Request::get('originals'), 

			                  		'category_id'=>Request::get('category_id'),

			                  		'sub_category_id'=>Request::get('sub_category_id')

			                  		]) }}">
			                  			<span class="text-blue"><b>{{ tr('csv') }}</b></span>
			                  		</a>
			                  	</li>
			                </ul>
						</li>
					</ul>

				@endif

                <!-- EXPORT OPTION END -->
            </div>

            @if($category || $sub_category || $genre || isset($_GET['downloadable']) || Request::get('category_id') || Request::get('originals') || Request::get('moderator_id'))
            
            @else

            <div class="box-header text-center">
                <span class="col-sm-4"><h4>{{tr('total_videos')}} : {{ $admin_videos->total_videos }}</h4></span>
               
                <span class="col-sm-4"><h4>{{tr('total_approved')}} : {{ $admin_videos->total_approved }}</h4></span>
               
                <span class="col-sm-4"><h4>{{tr('total_declined')}} : {{ $admin_videos->total_declined }}</h4></span>
            
            </div>
            
            @endif

            <div class="box-body">

            	<div class=" table-responsive"> 

				@include('admin.videos._search')

            		@if(count($admin_videos) > 0)

	              	<table id="example2" class="table table-bordered table-striped">

						<thead>
						    <tr>
								<th>{{tr('id')}}</th>
								<th>{{tr('action')}}</th>
								<th>{{tr('status')}}</th>
								<th>{{tr('title')}}</th>
								<th>{{tr('revenue')}}</th>
								<th>{{tr('ppv')}}</th>
								<th>{{tr('category')}}</th>
								<th>{{tr('sub_category')}}</th>
								<th>{{tr('genre')}} ({{tr('position')}})</th>
								<!-- <th>{{tr('viewers_cnt')}}</th> -->
								<th>{{tr('video_type')}}</th>
								<th>{{tr('banner')}}</th>
								<!-- <th>{{tr('position')}}</th> -->
								<th>{{tr('download')}}</th>
								<th>{{tr('uploaded_by')}}</th>
						    </tr>
						</thead>

						<tbody>
							@foreach($admin_videos as $i => $admin_video_details)

							    <tr>
							      	<td>{{ showEntries($_GET, $i+1) }}</td>

								    <td>

								    	@include('admin.videos._actions')
            							
								    </td>

								    <td>
							      		@if ($admin_video_details->compress_status < OVERALL_COMPRESS_COMPLETED)
							      			<span class="label label-danger">{{ tr('compress') }}</span>
							      		@else
								      		@if($admin_video_details->is_approved)
								      			<span class="label label-success">{{ tr('approved') }}</span>
								       		@else
								       			<span class="label label-warning">{{ tr('pending') }}</span>
								       		@endif
								       	@endif
							      	</td>

							      	<td>
							      		<a href="{{ route('admin.view.video' , ['id' => $admin_video_details->video_id]) }}">{{ substr($admin_video_details->title , 0,25) }}...</a>
							      		<p class="text-success"> <i class="fa fa-eye"></i> {{number_format_short($admin_video_details->watch_count)}} views</p>
							      	</td>
							      	

							      	<td>
							      		{{ formatted_amount($admin_video_details->admin_amount)}}</td>

							      	@if(Setting::get('is_payper_view'))
							      	<td class="text-center">
							      		@if($admin_video_details->amount > 0)
							      			<span class="label label-success">{{ tr('yes') }}</span>
							      		@else
							      			<span class="label label-danger">{{ tr('no') }}</span>
							      		@endif
							      	</td>
							      	@endif


							      	<td>
										
									  <a href="{{route('admin.categories.index',['category_id'=>$admin_video_details->category_id])}}">
									  {{ $admin_video_details->category_name ?: "-" }}
                                     </a>
									
									</td>
							      
							      	<td>

									  <a href="{{route('admin.sub_categories.index',['category_id'=>$admin_video_details->category_id])}}">
										  {{ $admin_video_details->sub_category_name ?: "-" }}
                                      </a>
										
									</td>
							      
							      	<td>
							      		{{ $admin_video_details->genre_name ?: '-' }} 
							      		@if($admin_video_details->genre_id > 0)
							      			
								      		@if($admin_video_details->position > 0)

									      		<span class="label label-success">{{ $admin_video_details->position }}</span>

									      	@else

									      		<span class="label label-danger">{{ $admin_video_details->position }}</span>

									      	@endif

									    @endif
									</td>

							      	<!-- <td>{{ number_format_short($admin_video_details->watch_count) }}</td> -->

							      	
                                    <td>
                                        @if($admin_video_details->video_type == 1)
                                            {{tr('video_upload_link')}}

                                            @if($admin_video_details->video_upload_type == VIDEO_UPLOAD_TYPE_s3)
                                           	({{tr('s3')}})
	                                        @endif

	                                        @if($admin_video_details->video_upload_type == VIDEO_UPLOAD_TYPE_DIRECT)
	                                            ({{tr('direct')}})
	                                        @endif 
                                        @endif

                                        @if($admin_video_details->video_type == 2)
                                            {{tr('youtube')}}
                                        @endif

                                        @if($admin_video_details->video_type == 3)
                                            {{tr('other_link')}}
                                        @endif
                                    </td>

							      	<td class="text-center">
							      		@if($admin_video_details->is_banner == BANNER_VIDEO)
							      			<span class="label label-success">{{ tr('yes') }}</span>
							      		@else
							      			<span class="label label-danger">{{ tr('no') }}</span>
							      		@endif
							      	</td>

							      	<!-- <td>

							      		@if ($admin_video_details->genre_id > 0)
							      			
								      		@if($admin_video_details->position > 0)

									      	<span class="label label-success">{{ $admin_video_details->position }}</span>

									      	@else

									      	<span class="label label-danger">{{ $admin_video_details->position }}</span>

									      	@endif

									    @else

									    	<span class="label label-warning">{{ tr('no') }}</span>

									    @endif

							      	</td> -->
							      	
							      	@if(Setting::get('theme') == 'default')
							      	<td>
							      		@if($admin_video_details->is_home_slider == 0 && $admin_video_details->is_approved && $admin_video_details->status)
							      			<a href="{{ route('admin.slider.video' ,['admin_video_id' => $admin_video_details->video_id] ) }}"><span class="label label-danger">{{ tr('set_slider') }}</span></a>
							      		@elseif($admin_video_details->is_home_slider)
							      			<span class="label label-success">{{ tr('slider') }}</span>
							      		@else
							      			-
							      		@endif
							      	</td>

							      	@endif

							      	<td class="text-center">
							      			
							      		@if($admin_video_details->download_status)
							      			<span class="text-success">
							      				<i class="fa fa-lg fa-download"></i>

							      				( {{ $admin_video_details->offline_videos_count }} )
							      			</span>

							      		@else
							      			<span class="label label-danger">{{ tr('no') }}</span>
							      		@endif

							      		
							      	</td>

							      	<td>

							      		@if(is_numeric($admin_video_details->uploaded_by))

							      			<a href="{{ route('admin.moderators.view',['moderator_id' => $admin_video_details->uploaded_by] ) }}">{{ $admin_video_details->moderator ? $admin_video_details->moderator->name : '' }}</a>

							      		@else 

							      			{{ $admin_video_details->uploaded_by }}

							      		@endif

							      	</td>

							    </tr>

								<!-- PPV Modal Popup-->

								<div id="{{ $admin_video_details->video_id }}" class="modal fade" role="dialog">

								  	<div class="modal-dialog">

									  	<form action="{{ route('admin.save.video-payment', $admin_video_details->video_id) }}" method="POST">
										    <!-- Modal content-->
										   	<div class="modal-content">

										      	<div class="modal-header">
										        	<button type="button" class="close" data-dismiss="modal">&times;</button>
										        	
										        	<h4 class="modal-title text-uppercase">

										        		<b>{{ tr('pay_per_view') }}</b>

										        		@if($admin_video_details->amount > 0)

						                  					<span class="text-green"><i class="fa fa-check-circle"></i></span>

						                  				@endif

										        	</h4>
										      	</div>

										   		<div class="modal-body">

											        <div class="row">

											        	<input type="hidden" name="ppv_created_by" id="ppv_created_by" value="{{ Auth::guard('admin')->user()->name }}">

											        	<div class="col-lg-12">
											        		<label class="text-uppercase">{{ tr('video') }}</label>
											        	</div>

											        	<div class="col-lg-12">

											        		<p>{{ $admin_video_details->title }}</p>

											        	</div>

											        	<div class="col-lg-12">
											        		<label class="text-uppercase">{{ tr('type_of_user') }} *</label>
											        	</div>

										                <div class="col-lg-12">

										                  	<div class="input-group">

										                        <input type="radio" name="type_of_user" value="{{ NORMAL_USER }}" {{ ($admin_video_details->type_of_user == 0 || $admin_video_details->type_of_user == '') ? 'checked' : (($admin_video_details->type_of_user == NORMAL_USER) ? 'checked' : '') }}>&nbsp;<label class="text-normal">{{ tr('normal_user') }}</label>&nbsp;
										                        
										                        <input type="radio" name="type_of_user" value="{{ PAID_USER }}" {{ ($admin_video_details->type_of_user == PAID_USER) ? 'checked' : '' }}>&nbsp;<label class="text-normal">{{ tr('paid_user') }}</label>&nbsp;
										                        
										                        <input type="radio" name="type_of_user" value="{{ BOTH_USERS }}" {{ ($admin_video_details->type_of_user == BOTH_USERS) ? 'checked' : '' }}>&nbsp;<label class="text-normal">{{ tr('both_user') }}</label>
										                  	</div>
										                  	
										                  	<!-- /input-group -->
										                </div>
										            </div>
										            <br>
										            <div class="row">
											        	<div class="col-lg-12">

											        		<label class="text-uppercase">{{ tr('type_of_subscription') }} *</label>

											        	</div>
										                <div class="col-lg-12">

										                  <div class="input-group">
										                        <input type="radio" name="type_of_subscription" value="{{ ONE_TIME_PAYMENT }}" {{ ($admin_video_details->type_of_subscription == 0 || $admin_video_details->type_of_subscription == '') ? 'checked' : (($admin_video_details->type_of_subscription == ONE_TIME_PAYMENT) ? 'checked' : '') }}>&nbsp;<label class="text-normal">{{ tr('one_time_payment') }}</label>&nbsp;
										                        <input type="radio" name="type_of_subscription" value="{{ RECURRING_PAYMENT }}" {{ ($admin_video_details->type_of_subscription == RECURRING_PAYMENT) ? 'checked' : '' }}>&nbsp;<label class="text-normal">{{ tr('recurring_payment') }}</label>
										                  </div>
										                  <!-- /input-group -->
										                </div>
										            
										            </div>

										            <br>
										            <div class="row">
											        	<div class="col-lg-12">
											        		<label class="text-uppercase">{{ tr('amount') }} *</label>
											        	</div>
										                <div class="col-lg-12">
										                    <input type="number" required value="{{ $admin_video_details->amount }}" name="amount" class="form-control" id="amount" placeholder="{{ tr('amount') }}" step="any">
										                </div>
										            
										            </div>

											    </div>
										      	
										      	<div class="modal-footer">
											      	<div class="pull-left">

											      		@if($admin_video_details->amount > 0)

											       			<a class="btn btn-danger" href="{{ route('admin.remove_pay_per_view', ['admin_video_id' => $admin_video_details->video_id] ) }}" onclick="return confirm(&quot;{{ tr('remove_ppv_confirmation') }}&quot;);">

											       				{{ tr('remove_pay_per_view') }}

											       			</a>
											       		@endif
											       	</div>

											        <div class="pull-right">
												        <button type="button" class="btn btn-default" data-dismiss="modal">{{ tr('close') }}</button>

												        <button type="submit" class="btn btn-primary" onclick="return confirm(&quot;{{ tr('set_ppv_confirmation') }}&quot;);">{{ tr('submit') }}</button>
												    </div>
											    	
											    	<div class="clearfix"></div>
										      	
										      	</div>
										    
										    </div>
										</form>
								  </div>

								</div>


								@if ($admin_video_details->compress_status >= OVERALL_COMPRESS_COMPLETED && $admin_video_details->is_approved && $admin_video_details->status)

								<!-- Modal -->
								
								@include('admin.videos._banner_video_modal')

								@endif

								@if ($admin_video_details->genre_id > 0 && $admin_video_details->is_approved && $admin_video_details->status)

								<div id="video_{{ $admin_video_details->video_id }}" class="modal fade" role="dialog">
								  <div class="modal-dialog">
								  <form action="{{ route('admin.save.video.position', ['admin_video_id' => $admin_video_details->video_id]) }}" method="POST">
									    <!-- Modal content-->
									   	<div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal">&times;</button>
									        <h4 class="modal-title">{{ tr('change_position') }}</h4>
									      </div>

									      <div class="modal-body">
									        
								            <div class="row">
									        	<div class="col-lg-3">
									        		<label>{{ tr('position') }}</label>
									        	</div>
								                <div class="col-lg-9">
								                       <input type="number" required value="{{ $admin_video_details->position }}" name="position" class="form-control" id="position" placeholder="{{ tr('position') }}" pattern="[0-9]{1,}" title="Enter 0-9 numbers">
								                  <!-- /input-group -->
								                </div>
								            </div>
									      </div>
									      <div class="modal-footer">
									        <div class="pull-right">
										        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										        <button type="submit" class="btn btn-primary">{{ tr('submit') }}</button>
										    </div>
										    <div class="clearfix"></div>
									      </div>
									    </div>
									</form>
								  </div>
								</div>

								@endif
							@endforeach
						</tbody>
					
					</table>

					<div align="right" id="paglink">
						
						<?php 

							echo $admin_videos->appends(['category_id' => isset($_GET['category_id']) ? $_GET['category_id'] : 0 , 'sub_category_id' => isset($_GET['sub_category_id']) ? $_GET['sub_category_id'] : 0 , 'genre_id' => isset($_GET['genre_id']) ? $_GET['genre_id'] : 0 , 'moderator_id' => isset($_GET['moderator_id']) ? $_GET['moderator_id'] : 0, 'search_key' => $search_key ?? "",'cast_crew_id' => isset($_GET['cast_crew_id']) ? $_GET['cast_crew_id'] : ''])->links(); 
						?>
							
					</div>

					@else
						<h3 class="no-result">{{ tr('no_video_found') }}</h3>
					@endif

				</div>
            
            </div>
          </div>
        </div>
    </div>

@endsection



@section('scripts')
<script type="text/javascript">
	
function loadFile(event, id){

    // alert(event.files[0]);
    var reader = new FileReader();

    reader.onload = function(){
      var output = document.getElementById(id);

      // alert(output);
      output.src = reader.result;
       //$("#imagePreview").css("background-image", "url("+this.result+")");
    };
    reader.readAsDataURL(event.files[0]);
}

window.setTimeout(function() {

	$(".sidebar-toggle").click();

}, 1000);

</script>
@endsection