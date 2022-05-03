<div id="banner_{{ $admin_video_details->video_id }}" class="modal fade" role="dialog">
								  	
  	<div class="modal-dialog">

		<form action="{{ route('admin.banner.set', ['admin_video_id'=>$admin_video_details->video_id]) }}" method="POST" enctype="multipart/form-data">
			@csrf
		    <!-- Modal content-->
		   	<div class="modal-content">
		      	
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	
		        	<h4 class="modal-title">{{ tr('set_banner_image') }}</h4>
		      	</div>

		      	<div class="modal-body">

			        <div class="row">

			    		<div class="col-lg-12">
			    			<p class="text-blue text-uppercase">
			    				{{  tr('banner_video_notes')  }}
			    			</p>
			    		</div>

			    		<div class="col-lg-12">

			    			<p>{{ $admin_video_details->title }}</p>

			    		</div>
			        	
			        	<div class="col-lg-12">

			        		<h4><b>{{ tr('banner_image_for_website') }} *</b></h4>

			        		<p class="help-block">{{tr('banner_image_for_website_notes')}}</p>
			        	</div>

			            <div class="col-lg-12">

			              <div class="input-group">

			                    <input type="file" id="banner_image_file_{{ $admin_video_details->video_id }}" accept="image/*" name="banner_image" placeholder="{{ tr('banner_image') }}" style="display:none" onchange="loadFile(this,'banner_image_{{ $admin_video_details->video_id }}')" />

			                    <div>
			                        <img src="{{ ($admin_video_details->is_banner) ? $admin_video_details->banner_image : asset('images/banner-preview.png') }}" style="width:300px;height:150px;cursor: pointer;opacity: 0.9;" 
			                        onclick="$('#banner_image_file_{{ $admin_video_details->video_id }}').click();return false;" id="banner_image_{{ $admin_video_details->video_id }}"/>
			                    </div>
			                    
			              </div>
			              <!-- /input-group -->
			            
			            </div>

			            <hr>

			            <div class="col-lg-12">

			        		<h4><b>{{ tr('mobile_banner_image') }} *</b></h4>
			        		<p class="help-block">{{tr('mobile_banner_image_notes')}}</p>
			        	</div>

			            <div class="col-lg-12">

			              <div class="input-group">

			                    <input type="file" id="mobile_banner_image_file_{{ $admin_video_details->video_id }}" accept="image/png,image/jpeg" name="mobile_banner_image" placeholder="{{ tr('mobile_banner_image') }}" style="display:none" onchange="loadFile(this,'mobile_banner_image_{{ $admin_video_details->video_id }}')" />

			                    <div>
			                        <img src="{{ ($admin_video_details->is_banner) ? $admin_video_details->mobile_banner_image : asset('images/banner-preview.png') }}" style="width:300px;height:150px;cursor: pointer;opacity: 0.9;" 
			                        onclick="$('#mobile_banner_image_file_{{ $admin_video_details->video_id }}').click();return false;" id="mobile_banner_image_{{ $admin_video_details->video_id }}"/>
			                    </div>
			                    
			              </div>
			              <!-- /input-group -->
			            
			            </div>
			        
			        </div>

		        	<br>
		      	</div>
		      	
		      	<div class="modal-footer">

			      	@if($admin_video_details->is_banner == BANNER_VIDEO)

			      	<div class="pull-left">

			      		<?php $remove_banner_image_notes = tr('remove_banner_image_notes');?>

			          	<a onclick="return confirm('{{ $remove_banner_image_notes }}')" role="menuitem" tabindex="-1" href="{{ route('admin.banner.remove',['admin_video_id'=>$admin_video_details->video_id]) }}" class="btn btn-danger">{{ tr('remove_banner_image') }}</a>

			      	</div>

			      	@endif

			        <div class="pull-right">
				        <button type="button" class="btn btn-default" data-dismiss="modal">{{ tr('close') }}</button>

				        <button type="submit" class="btn btn-primary" onclick="return confirm(&quot;{{ tr('set_banner_image_confirmation') }}&quot;);">{{ tr('submit') }}</button>
				    </div>
			    	<div class="clearfix"></div>
		     	
		     	</div>

		    </div>
		
		</form>

  	</div>
</div>