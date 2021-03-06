	@extends('layouts.admin')

@section('title', tr('sub_admin_view'))

@section('content-header', tr('sub_admin_view'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.sub_admins.index')}}"><i class="fa fa-user"></i> {{tr('sub_admins')}}</a></li>
    <li class="active"><i class="fa fa-support"></i> {{tr('sub_admin_view')}}</li>
@endsection

@section('content')

	<style type="text/css">
		.timeline::before {
		    content: '';
		    position: absolute;
		    top: 0;
		    bottom: 0;
		    width: 0;
		    background: #fff;
		    left: 0px;
		    margin: 0;
		    border-radius: 0px;
		}
	</style>

	<div class="row">

		<div class="col-md-10 col-md-offset-1">
			
    		<div class="box box-widget widget-user-2">

            	<div class="widget-user-header bg-gray">

            		<div class="pull-left">

	              		<div class="widget-user-image">

	                		<img class="img-circle" src=" @if($sub_admin_details->picture) {{$sub_admin_details->picture}} @else {{asset('admin-css/dist/img/avatar.png')}} @endif" alt="{{$sub_admin_details->name}}">
	              		</div>

	              		<h3 class="widget-user-username">{{$sub_admin_details->name}} </h3>
	      				<h5 class="widget-user-desc">{{tr('sub_admin')}}</h5>
      				</div>

      				<div class="pull-right">
      				
						@if(Setting::get('admin_delete_control') == YES)

		                  	<a class="btn btn-sm btn-warning" href="javascript:;" title="{{tr('edit')}}"><b><i class="fa fa-edit"></i> {{ tr('edit') }}</b></a>

		                  	<a class="btn btn-sm btn-danger" href="javascript:;" title="{{tr('delete')}}"><b><i class="fa fa-trash"></i> {{ tr('delete') }}</b></a>

	                  	@else
	                  	
		                  	<a class="btn btn-sm btn-warning" href="{{ route('admin.sub_admins.edit' , ['sub_admin_id'=>$sub_admin_details->id] ) }}" title="{{tr('edit')}}"><b><i class="fa fa-edit"></i> {{ tr('edit') }}</b></a>

		                  	<a class="btn btn-sm btn-danger" href="{{ route('admin.sub_admins.delete' , ['sub_admin_id' => $sub_admin_details->id]) }}" onclick="return confirm(&quot;{{ tr('admin_sub_admin_delete_confirmation' , $sub_admin_details->name) }}&quot;);" title="{{tr('delete')}}" ><b><i class="fa fa-trash"></i> {{ tr('delete') }}</b></a>
	                  	
	                  	@endif

	                  	@if($sub_admin_details->is_activated == YES )
	                  		<a class="btn btn-sm btn-warning" onclick="return confirm(&quot;{{ $sub_admin_details->name }} - {{ tr('admin_sub_admin_decline_confirmation') }}&quot;);" tabindex="-1" href="{{ route('admin.sub_admins.status' , ['sub_admin_id' => $sub_admin_details->id]) }}" title="{{tr('decline')}}"> <b><i class="fa fa-close"></i> {{ tr('decline') }}</b></a>
	                  	 @else 
	                  	 	<a class="btn btn-sm btn-success" onclick="return confirm(&quot;{{ $sub_admin_details->name }} - {{ tr('admin_sub_admin_approve_confirmation') }}&quot;);" tabindex="-1" href="{{ route('admin.sub_admins.status' , ['sub_admin_id'=>$sub_admin_details->id]) }}" title="{{tr('approve')}}"> <b><i class="fa fa-check"></i> {{ tr('approve') }} </b></a>
	                  	@endif
      				</div>
      				<div class="clearfix"></div>
            	</div>	
            	
            	<div class="box-footer no-padding">
            		<div class="col-md-6">
	              		<ul class="nav nav-stacked">

			                <li><a href="#">{{tr('username')}} <span class="pull-right">{{$sub_admin_details->name}}</span></a></li>
			               
			                <li><a href="#">{{tr('email')}} <span class="pull-right">{{$sub_admin_details->email}}</span></a></li>
			                
			                <li><a href="#">{{tr('mobile')}} <span class="pull-right">{{$sub_admin_details->mobile}}</span></a></li>
			                		             
			                <li>
			                	<a href="#">{{tr('status')}} 
			                		<span class="pull-right">
			                			@if($sub_admin_details->is_activated) 
							      			<span class="label label-success">{{tr('approved')}}</span>
							       		@else 
							       			<span class="label label-warning">{{tr('pending')}}</span>
							       		@endif
			                		</span>
			                	</a>
			                </li>
			                <li><a href="#">{{tr('description')}} 
			                	<div  class="text-word-wrap">
 								{{$sub_admin_details->description}}
 								</div></a>
 							</li>
 							
			             
	              		</ul>
            		</div>

	            	<div class="col-md-6">

	            		<ul class="nav nav-stacked">

			                <li><a href="#">{{tr('timezone')}} <span class="pull-right">{{$sub_admin_details->timezone ? $sub_admin_details->timezone : "-"}}</span></a></li>

			                <li><a href="#">{{tr('created_at')}} <span class="pull-right">{{convertTimeToUSERzone($sub_admin_details->created_at, Auth::guard('admin')->user()->timezone, 'd-m-Y H:i')}}</span></a></li>

			                <li><a href="#">{{tr('updated_at')}} <span class="pull-right">{{convertTimeToUSERzone($sub_admin_details->updated_at, Auth::guard('admin')->user()->timezone, 'd-m-Y H:i')}}</span></a></li>
	              		</ul>
	            	</div>

          		</div>

          	</div>

		</div>

    </div>

@endsection


