											                 
@extends('layouts.admin')

@section('title', $title)

@section('content-header', tr('store'))

@section('breadcrumb')

   	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>

    <li class="active"><i class="fa fa-support"></i> {{ tr('store') }}</li>

	<li class="active"><i class="fa fa-support"></i> @if(Request::get('sort')!='')  {{tr('declined_store')}} @else {{tr('view_store') }} @endif</li>
    
@endsection

@section('content')

	<div class="row">

        <div class="col-xs-12">
          	
          	<div class="box box-warning">

	            <div class="box-header table-header-theme">
	                <b style="font-size:18px;">{{$title}}</b>
	                <a href="{{ route('admin.store.create') }}" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Store User Create<!-- {{ tr('store_create') }}--></a>

	               @if(count($store) > 0 )

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

				<form  action="{{route('admin.store.bulk_action')}}" id="store" method="POST" role="search">

					@csrf

					<input type="hidden" name="action_name" id="action" value="">

					<input type="hidden" name="selected_stores" id="selected_ids" value="">

					<input type="hidden" name="page_id" id="page_id" value="{{ (request()->page) ? request()->page : '1' }}">

				</form>
			</div>

	            <div class="box-header">
	                <span class="col-sm-4"><h4>{{tr('total_store')}} : {{ $store->total_store }}</h4></span>

	                <span class="col-sm-4"><h4>{{tr('total_approved')}} : {{ $store->total_approved }}</h4></span>
	                
	                <span class="col-sm-4"><h4>{{tr('total_declined')}} : {{ $store->total_declined }}</h4></span>
	            </div>

	            <div class="box-body">
	            	
	            	<div class="table-responsive"> 

                       @include('admin.store._search')

	            		<div class="table table-responsive">
			              	
			              	<table  class="table table-bordered table-striped ">

								<thead>
									@if($store->count() == 0)
										<div class="mt-5">
											<h2 class="text-center"> {{ tr('no_result_found') }} </h2>
										</div>
									@else

								    <tr>
								    	<th>
								    		<input id="check_all" type="checkbox">
								    	</th>
										<th>{{ tr('id') }}</th>
										<th>Name<!--{{ tr('store') }}--></th>
										<th>{{ tr('email') }}</th>
										<th>{{ tr('mobile') }}</th>
										<th>{{ tr('status') }}</th>
										<th>{{ tr('action') }}</th>
								    </tr>
								
								</thead>

								<tbody>
									
									@foreach($store as $i => $store_details)

									    <tr>
									    	<td><input type="checkbox" name="row_check" class="faChkRnd" id="{{$store_details->id}}" value="{{$store_details->id}}"></td>
									      	<td>{{ $i+1 }}</td>
									      	<td>
									      		<a href="{{ route('admin.store.view' , ['store_id' => $store_details->id]) }}">
									      			{{ $store_details->name }}
									      		</a>
									      	</td>

									      	<td>{{ $store_details->email }}</td>      	
									      
									      	<td>
									      		{{ $store_details->mobile }}
									      	</td>
									      	
									      	<td>
										      	@if($store_details->is_activated)

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

										                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.store.view' , ['store_id' => $store_details->id]) }}">{{ tr('view') }}</a></li>

										                  	@if(Setting::get('admin_delete_control') == YES)

											                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;">{{ tr('edit') }}</a></li>

											                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;">{{ tr('delete') }}</a></li>

										                  	@else
										                  	
											                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.store.edit' , ['store_id'=>$store_details->id] ) }}">{{ tr('edit') }}</a></li>

											                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.store.delete' , ['store_id' => $store_details->id]) }}" onclick="return confirm(&quot;{{ tr('admin_store_delete_confirmation' , $store_details->name) }}&quot;);" >{{ tr('delete') }}</a></li>
										                  	
										                  	@endif

										                  	@if($store_details->is_activated == YES )
										                  		<li role="presentation"><a role="menuitem" onclick="return confirm(&quot;{{ $store_details->name }} - {{ tr('admin_store_decline_confirmation') }}&quot;);" tabindex="-1" href="{{ route('admin.store.status' , ['store_id' => $store_details->id]) }}"> {{ tr('decline') }}</a></li>
										                  	 @else 
										                  	 	<li role="presentation"><a role="menuitem" onclick="return confirm(&quot;{{ $store_details->name }} - {{ tr('admin_store_approve_confirmation') }}&quot;);" tabindex="-1" href="{{ route('admin.store.status' , ['store_id'=>$store_details->id]) }}"> 
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

							<?php echo $store->appends(request()->input())->links(); ?>

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
						var message = "<?php echo tr('admin_store_delete_confirmation') ?>";
					}else if(selected_action == 'bulk_approve'){
						var message = "<?php echo tr('admin_store_approve_confirmation') ?>";
					}else if(selected_action == 'bulk_decline'){
						var message = "<?php echo tr('admin_store_decline_confirmation') ?>";
					}
					var confirm_action = confirm(message);

					if (confirm_action == true) {
					  $( "#store" ).submit();
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

		localStorage.setItem("store_checked_items"+page, JSON.stringify(checked_ids));

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

			localStorage.setItem("store_checked_items"+page, JSON.stringify(checked_ids));
			get_values();
		} else {
			$("input:checkbox[name='row_check']").prop("checked", false);
			localStorage.removeItem("store_checked_items"+page);
			get_values();
		}

	});


	function get_values(){
		var pageKeys = Object.keys(localStorage).filter(key => key.indexOf('store_checked_items') === 0);
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
