@extends('layouts.admin')

@section('title', tr('view_admin'))

@section('content-header', tr('view_admin'))

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>{{ tr('home') }}</a></li>
    <li><a href="{{ route('admin.admins.index') }}"><i class="fa fa-user"></i> {{ tr('admins') }}</a></li>
    <li class="active"><i class="fa fa-user-plus"></i> {{ tr('view_admin') }}</li>
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

	                		<img class="img-circle" src=" @if($admin_details->picture) {{ $admin_details->picture }} @else {{ asset('admin-css/dist/img/avatar.png') }} @endif" alt="{{ $admin_details->name }}">
	              		</div>

	              		<h3 class="widget-user-username">{{ $admin_details->name }} </h3>
	      				<h5 class="widget-user-desc">{{ tr('user') }}</h5>
      				</div>
      				<div class="pull-right">
      					<a href="{{ route('admin.admins.edit' , ['admin_id' => $admin_details->id] ) }}" class="btn btn-sm btn-warning">{{ tr('edit') }}</a>
      				</div>
      				<div class="clearfix"></div>
            	</div>	
            	
            	<div class="box-footer no-padding">
            		
            		<div class="col-md-6">

	              		<ul class="nav nav-stacked">
			                <li><a href="#">{{ tr('username') }} <span class="pull-right">{{ $admin_details->name }}</span></a></li>

			                <li><a href="#">{{ tr('email') }} <span class="pull-right">{{ $admin_details->email }}</span></a></li>

			                <li><a href="#">{{ tr('mobile') }} <span class="pull-right">{{ $admin_details->mobile }}</span></a></li>

			                <li>
			                	<a href="#">{{ tr('status') }} 
			                		<span class="pull-right">
			                			@if($admin_details->is_activated) 
							      			<span class="label label-success">{{ tr('approved') }}</span>
							       		@else 
							       			<span class="label label-warning">{{ tr('pending') }}</span>
							       		@endif
			                		</span>
			                	</a>
			                </li>

			                <li>
			                	<a href="#">{{ tr('description') }}
			                		<br>
			                		<br>
			                		<p class="">{{ $admin_details->description }}</span></p>
			                	</a>
			                </li>		             
	              		</ul>

            		</div>

	            	<div class="col-md-6">

	            		<ul class="nav nav-stacked">

			                <li><a href="#">{{ tr('timezone') }} <span class="pull-right">{{ $admin_details->timezone ? $admin_details->timezone : "-" }}</span></a></li>

			                <li><a href="#">{{ tr('created_at') }} <span class="pull-right">{{ convertTimeToUSERzone($admin_details->created_at, Auth::guard('admin')->user()->timezone, 'd-m-Y H:i a') }}</span></a></li>

			                <li><a href="#">{{ tr('updated_at') }} <span class="pull-right">{{ convertTimeToUSERzone($admin_details->updated_at, Auth::guard('admin')->user()->timezone, 'd-m-Y H:i a') }}</span></a></li>

	              		</ul>

	            	</div>

          		</div>

          	</div>

		</div>

    </div>

@endsection




