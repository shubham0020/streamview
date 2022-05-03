											                 
@extends('layouts.admin')

@section('title', $title)

@section('content-header', tr('sub_admins'))

@section('breadcrumb')

   	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>

    <li class="active"><i class="fa fa-support"></i> {{ tr('sub_admins') }}</li>

	<li class="active"><i class="fa fa-support"></i> @if(Request::get('sort')!='')  {{tr('declined_sub_admins')}} @else {{tr('view_sub_admins') }} @endif</li>
    
@endsection

@section('content')

	<div class="row">

        <div class="col-xs-12">
          	
          	<div class="box box-warning">

	            <div class="box-header table-header-theme">
	                <b style="font-size:18px;">{{$title}}</b>
	                <a href="{{ route('admin.sub_admins.create') }}" class="btn btn-default pull-right"><i class="fa fa-plus"></i> {{ tr('sub_admin_create') }}</a>

	               @if(count($sub_admins) > 0 )

					<ul class="admin-action btn btn-default pull-right" style="margin-right: 20px">

						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								{{ tr('admin_bulk_action') }} <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li role="presentation" class="action_list" id="bulk_delete">
									<a role="menuitem" tabindex="-1" href="#">	<span class="text-red"><b>{{ tr('delete') }}</b> </span></a>
								</li>
								<li role="presentation" class="action_list" id="bulk_approve">
									<a role="menuitem" tabindex="-1" href="#">	<span class="text-blue"><b>{{ tr('approve') }}</b></span></a>
								</li>

								<li role="presentation" class="action_list" id="bulk_decline">
									<a role="menuitem" tabindex="-1" href="#"><span class="text-blue"><b>{{ tr('decline') }}</b></span></a>
								</li>

							</ul>
						</li>
					</ul>

				@endif
	            </div>

	            <div class="bulk_action">

				<form  action="{{route('admin.sub_admins.bulk_action')}}" id="sub_admins" method="POST" role="search">

					@csrf

					<input type="hidden" name="action_name" id="action" value="">

					<input type="hidden" name="selected_subadmins" id="selected_ids" value="">

					<input type="hidden" name="page_id" id="page_id" value="{{ (request()->page) ? request()->page : '1' }}">

				</form>
			</div>

	            <div class="box-header">
	                <span class="col-sm-4"><h4>{{tr('total_sub_admins')}} : {{ $sub_admins->total_sub_admins }}</h4></span>

	                <span class="col-sm-4"><h4>{{tr('total_approved')}} : {{ $sub_admins->total_approved }}</h4></span>
	                
	                <span class="col-sm-4"><h4>{{tr('total_declined')}} : {{ $sub_admins->total_declined }}</h4></span>
	            </div>

	            <div class="box-body">
	            	
	            	<div class="table-responsive"> 

                       @include('admin.sub_admins._search')

	            		<div class="table table-responsive">
			              	
			              	<table  class="table table-bordered table-striped ">

								<thead>
									@if($sub_admins->count() == 0)
										<div class="mt-5">
											<h2 class="text-center"> {{ tr('no_result_found') }} </h2>
										</div>
									@else

								    <tr>
								    	<th>
								    		<input id="check_all" type="checkbox">
								    	</th>
										<th>{{ tr('id') }}</th>
										<th>{{ tr('subadmin_name') }}</th>
										<th>{{ tr('email') }}</th>
										<th>{{ tr('mobile') }}</th>
										<th>{{ tr('status') }}</th>
										<th>{{ tr('action') }}</th>
								    </tr>
								
								</thead>

								<tbody>
									
									@foreach($sub_admins as $i => $sub_admin_details)

									    <tr>
									    	<td><input type="checkbox" name="row_check" class="faChkRnd" id="{{$sub_admin_details->id}}" value="{{$sub_admin_details->id}}"></td>
									      	<td>{{ $i+1 }}</td>
									      	<td>
									      		<a href="{{ route('admin.sub_admins.view' , ['sub_admin_id' => $sub_admin_details->id]) }}">
									      			{{ $sub_admin_details->name }}
									      		</a>
									      	</td>

									      	<td>{{ $sub_admin_details->email }}</td>      	
									      
									      	<td>
									      		{{ $sub_admin_details->mobile }}
									      	</td>
									      	
									      	<td>
										      	@if($sub_admin_details->is_activated)

										      		<span class="label label-success">{{ tr('approved') }}</span>

										      	@else

										      		<span class="label label-warning">{{ tr('pending') }}</span>

										      	@endif

									     	</td>
									 
									      	<td>
		            							<ul class="admin-action btn btn-default">
		            								<li class="@if($i < 2) dropdown @else dropup @endif">
										                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
										                  {{ tr('action') }} <span class="caret"></span>
										                </a>
										                <ul class="dropdown-menu dropdown-menu-right">

										                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.sub_admins.view' , ['sub_admin_id' => $sub_admin_details->id]) }}">{{ tr('view') }}</a></li>

										                  	@if(Setting::get('admin_delete_control') == YES)

											                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;">{{ tr('edit') }}</a></li>

											                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;">{{ tr('delete') }}</a></li>

										                  	@else
										                  	
											                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.sub_admins.edit' , ['sub_admin_id'=>$sub_admin_details->id] ) }}">{{ tr('edit') }}</a></li>

											                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.sub_admins.delete' , ['sub_admin_id' => $sub_admin_details->id]) }}" onclick="return confirm(&quot;{{ tr('admin_sub_admin_delete_confirmation' , $sub_admin_details->name) }}&quot;);" >{{ tr('delete') }}</a></li>
										                  	
										                  	@endif

										                  	@if($sub_admin_details->is_activated == YES )
										                  		<li role="presentation"><a role="menuitem" onclick="return confirm(&quot;{{ $sub_admin_details->name }} - {{ tr('admin_sub_admin_decline_confirmation') }}&quot;);" tabindex="-1" href="{{ route('admin.sub_admins.status' , ['sub_admin_id' => $sub_admin_details->id]) }}"> {{ tr('decline') }}</a></li>
										                  	 @else 
										                  	 	<li role="presentation"><a role="menuitem" onclick="return confirm(&quot;{{ $sub_admin_details->name }} - {{ tr('admin_sub_admin_approve_confirmation') }}&quot;);" tabindex="-1" href="{{ route('admin.sub_admins.status' , ['sub_admin_id'=>$sub_admin_details->id]) }}"> 
										                  		{{ tr('approve') }} </a></li>
										                  	@endif

										                  
										                  	<li role="presentation" class="divider"></li>


										                </ul>

		              								</li>

		            							</ul>
									      	
									      	</td>

									    </tr>

									@endforeach
									@endif
								
								</tbody>
							
							</table>

							<?php echo $sub_admins->appends(request()->input())->links(); ?>

						</div>

					</div>

	            </div>

          	</div>

        </div>
    
    </div>

@endsection

@section('scripts')
    
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
@if(Session::has('bulk_action'))
<script type="text/javascript">
	$(document).ready(function(){
		localStorage.clear();
	});
</script>
@endif

<script type="text/javascript">

	$(document).ready(function(){
		get_values();

		$('.action_list').click(function(){
			var selected_action = $(this).attr('id');
			if(selected_action != undefined){
				$('#action').val(selected_action);
				if($("#selected_ids").val() != ""){
					if(selected_action == 'bulk_delete'){
						var message = "<?php echo tr('admin_sub_admins_delete_confirmation') ?>";
					}else if(selected_action == 'bulk_approve'){
						var message = "<?php echo tr('admin_sub_admins_approve_confirmation') ?>";
					}else if(selected_action == 'bulk_decline'){
						var message = "<?php echo tr('admin_sub_admins_decline_confirmation') ?>";
					}
					var confirm_action = confirm(message);

					if (confirm_action == true) {
					  $( "#sub_admins" ).submit();
					}
					// 
				}else{
					alert('Please select the check box');
				}
			}
		});
	// single check
	var page = $('#page_id').val();
	$(':checkbox[name=row_check]').on('change', function() {
		var checked_ids = $(':checkbox[name=row_check]:checked').map(function() {
			return this.id;
		})
		.get();

		localStorage.setItem("subAdmin_checked_items"+page, JSON.stringify(checked_ids));

		get_values();

	});
	// select all checkbox
	$("#check_all").on("click", function () {
		if ($("input:checkbox").prop("checked")) {
			$("input:checkbox[name='row_check']").prop("checked", true);
			var checked_ids = $(':checkbox[name=row_check]:checked').map(function() {
				return this.id;
			})
			.get();

			localStorage.setItem("subAdmin_checked_items"+page, JSON.stringify(checked_ids));
			get_values();
		} else {
			$("input:checkbox[name='row_check']").prop("checked", false);
			localStorage.removeItem("subAdmin_checked_items"+page);
			get_values();
		}

	});


	function get_values(){
		var pageKeys = Object.keys(localStorage).filter(key => key.indexOf('subAdmin_checked_items') === 0);
		var values = Array.prototype.concat.apply([], pageKeys.map(key => JSON.parse(localStorage[key])));

		if(values){
			$('#selected_ids').val(values);
		}

		for (var i=0; i<values.length; i++) {
			$('#' + values[i] ).prop("checked", true);
		}

}

});
</script>
