@extends('layouts.admin')

@section('title', tr('admins'))

@section('content-header') 

	{{tr('admins')}} 

@endsection

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li class="active"><i class="fa fa-user"></i> {{tr('admins')}}</li>
@endsection

@section('content')

	<div class="row">

        <div class="col-xs-12">
          	
          	<div class="box box-warning">
          	
	          	<div class="box-header table-header-theme">	                
	          		<b style="font-size:18px;">
	          			{{tr('admins')}}
	          		</b>
	               
	                <a href="{{route('admin.admins.create')}}" class="btn btn-default pull-right"><i class="fa fa-plus"></i> {{tr('create_admin')}}</a>
	            </div>
            
	            <div class="box-body">

	            	<div class="table-responsive" style="padding: 35px 0px"> 
	            		
	            		<div class="table table-responsive">
			              	
			              	<table id="example1" class="table table-bordered table-striped ">
								<thead>
								    <tr>
										<th>{{tr('id')}}</th>
										<th>{{tr('username')}}</th>
										<th>{{tr('email')}}</th>
										<th>{{tr('mobile')}}</th>
										<th>{{tr('status')}}</th>
										<th>{{tr('action')}}</th>
								    </tr>
								
								</thead>

								<tbody>

									@foreach($admins as $i => $admin_details)

									    <tr>
									      	<td>{{ $i+1 }}</td>

									      	<td>
									      		<a href="{{route('admin.users.view' , ['user_id' => $admin_details->id])}}">
									      			{{$admin_details->name}}
									      		</a>
									      	</td>

									      	<td>{{$admin_details->email}}</td>	
									      
									      	<td>{{$admin_details->mobile}}</td>
									      	
									      	<td>
										      	@if($admin_details->is_activated)
										      		<span class="label label-success">{{tr('approve')}}</span>
										      	@else
										      		<span class="label label-warning">{{tr('pending')}}</span>
										      	@endif
									     	</td>
									 
									      	<td>
		            							<ul class="admin-action btn btn-default">
		            								<li class="@if($i < 2) dropdown @else dropup @endif">
										                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
										                  {{tr('action')}} <span class="caret"></span>
										                </a>

										                <ul class="dropdown-menu dropdown-menu-right">
										                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('admin.admins.edit' , ['admin_id' => $admin_details->id] )}}">{{tr('edit')}}</a></li>

										                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('admin.admins.view' , ['admin_id' => $admin_details->id]  )}}">{{tr('view')}}</a></li>

										                  	@if($admin_details->is_activated)
										                  		<li role="presentation"><a role="menuitem" onclick="return confirm(&quot;{{$admin_details->name}} - {{tr('admin_decline_confirmation')}}&quot;);" tabindex="-1" href="{{route('admin.admins.status' , ['admin_id' => $admin_details->id] )}}"> {{tr('decline')}}</a></li>
										                  	 @else 
										                  	 	<li role="presentation"><a role="menuitem" onclick="return confirm(&quot;{{$admin_details->name}} - {{tr('admin_approve_confirmation')}}&quot;);" tabindex="-1" href="{{route('admin.users.status.change' , ['admin_id' => $admin_details->id]  )}}"> 
										                  		{{tr('approve')}} </a></li>
										                  	@endif

										                  
										                  	<li role="presentation" class="divider"></li>

										                    <li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('admin.admins.delete' , ['admin_id' => $admin_details->id] )}}">{{tr('delete')}}</a></li>
										                  	

										                </ul>

		              								</li>

		            							</ul>
									      	
									      	</td>

									    </tr>

									@endforeach
								
								</tbody>
							
							</table>
						
						</div>						
						
					</div>

	            </div>

          	</div>

        </div>
    
    </div>

@endsection
