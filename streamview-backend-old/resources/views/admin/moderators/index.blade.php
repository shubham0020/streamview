@extends('layouts.admin')

@section('title', $title)

@section('content-header', tr('moderators'))

@section('breadcrumb')
<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>{{ tr('home') }}</a></li>
<li><a href="{{route('admin.moderators.index')}}"><i class="fa fa-users"></i> {{tr('moderators')}}</a></li>

<li class="active"><i class="fa fa-users"></i> @yield('title')</li>

<li class="active"><i class="fa fa-users"></i> @if(Request::get('sort')!='')  {{tr('declined_moderators')}} @else {{tr('view_moderators') }} @endif</li>


@endsection

@section('content')

<div class="row">

	<div class="col-xs-12">

		<div class="box box-warning">

			<div class="box-header table-header-theme">
				<b style="font-size:18px;">@yield('title')</b>
				<a href="{{ route('admin.moderators.create') }}" class="btn btn-default pull-right"><i class="fa fa-plus"></i> {{ tr('add_moderator') }}</a>

				<!-- EXPORT OPTION START -->

				@if(count($moderators) > 0 )

				<ul class="admin-action btn btn-default pull-right" style="margin-right: 20px">

					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							{{ tr('export') }} <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li role="presentation">
								<a role="menuitem" tabindex="-1" href="{{ route('admin.moderators.export' , ['format' => 'XLSX']) }}">
									<span class="text-red"><b>{{ tr('excel_sheet') }}</b></span>
								</a>
							</li>

							<li role="presentation">
								<a role="menuitem" tabindex="-1" href="{{ route('admin.moderators.export' , ['format' => 'csv']) }}">
									<span class="text-blue"><b>{{ tr('csv') }}</b></span>
								</a>
							</li>
						</ul>
					</li>
				</ul>

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

				<!-- EXPORT OPTION END -->

			</div>

			<div class="bulk_action">

				<form  action="{{route('admin.moderators.bulk_action')}}" id="moderator" method="POST" role="search">

					@csrf

					<input type="hidden" name="action_name" id="action" value="">

					<input type="hidden" name="selected_moderators" id="selected_ids" value="">

					<input type="hidden" name="page_id" id="page_id" value="{{ (request()->page) ? request()->page : '1' }}">

				</form>
			</div>

			<div class="box-header text-center">
				<span class="col-sm-4">
					<h4>{{tr('total_moderator')}} : {{ $moderators->total_moderator }}</h4>
				</span>
				<span class="col-sm-4">
					<h4>{{tr('total_approved')}} : {{ $moderators->total_approved }}</h4>
				</span>
				<span class="col-sm-4">
					<h4>{{tr('total_declined')}} : {{ $moderators->total_declined }}</h4>
				</span>
			</div>

			<div class="box-body">

				<div class="table-responsive ">

					@include('admin.moderators._search')

					@if(count($moderators) > 0)

					<table class="table table-bordered table-striped table-top">

						<thead>
							<tr>
								<th>
									 <input id="check_all" type="checkbox">
								</th>
								<th>{{ tr('id') }}</th>
								<th>{{ tr('moderator_name') }}</th>
								<th>{{ tr('email') }}</th>
								<th>{{ tr('mobile') }}</th>
								<th>{{ tr('address') }}</th>
								<th>{{ tr('total_videos') }}</th>
								<th>{{ tr('total') }}</th>
								<th>{{ tr('status') }}</th>
								<th>{{ tr('action') }}</th>
							</tr>
						</thead>

						<tbody>

							@foreach($moderators as $i => $moderator_details)

							<tr>
								<td><input type="checkbox" name="row_check" class="faChkRnd" id="{{$moderator_details->id}}" value="{{$moderator_details->id}}"></td>
								<td>{{ showEntries($_GET, $i+1) }}</td>
								<td><a href="{{ route('admin.moderators.view',['moderator_id' => $moderator_details->id] ) }}">{{ $moderator_details->name }}</a></td>
								<td>{{ $moderator_details->email ? $moderator_details->email : '-' }}</td>
								<td>{{ $moderator_details->mobile ? $moderator_details->mobile : '-'}}</td>
								<td>{{ $moderator_details->address ?: tr('not_available')}}</td>
								<td><a href="{{ route('admin.videos',['moderator_id' => $moderator_details->id] ) }}">{{ $moderator_details->moderatorVideos ? $moderator_details->moderatorVideos->count() : 0 }}</a></td>
								<td>{{ formatted_amount($moderator_details->total ?? "0.00") }}</td>

								<td>
									@if($moderator_details->is_activated)
									<span class="label label-success">{{ tr('approved') }}</span>
									@else
									<span class="label label-warning">{{ tr('declined') }}</span>
									@endif
								</td>

								<td>
									<ul class="admin-action btn btn-default">
										<li class="dropdown">

											<a class="dropdown-toggle" data-toggle="dropdown" href="#">
												{{ tr('action') }} <span class="caret"></span>
											</a>

											<ul class="dropdown-menu dropdown-menu-right">

												<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.moderators.view',['moderator_id' => $moderator_details->id] ) }}">{{ tr('view') }}</a></li>

												@if(Setting::get('admin_delete_control'))

												<li role="presentation"><a role="button" href="javascript:;" class="btn disabled" style="text-align: left">{{ tr('edit') }}</a></li>

												<li><a role="button" href="javascript:;" class="btn disabled" style="text-align: left">{{ tr('delete') }}</a></li>
												@else
												<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.moderators.edit',['moderator_id' => $moderator_details->id] ) }}">{{ tr('edit') }}</a></li>

												<li role="presentation">
													<a role="menuitem" tabindex="-1" onclick="return confirm(&quot;{{ tr('admin_moderator_delete_confirmation' , $moderator_details->name) }}&quot;);" href="{{ route('admin.moderators.delete', ['moderator_id' => $moderator_details->id] ) }}">{{ tr('delete') }}</a>
												</li>

												@endif

												<li role="presentation" class="divider"></li>
												@if($moderator_details->is_activated)
												<li role="presentation"><a role="menuitem" tabindex="-1" onclick="return confirm(&quot;{{ tr('moderator_decline_confirmation' , $moderator_details->name) }}&quot;);" href="{{ route('admin.moderators.status.change', ['moderator_id' => $moderator_details->id] ) }}">{{ tr('decline') }}</a></li>
												@else
												<li role="presentation"><a role="menuitem" tabindex="-1" onclick="return confirm(&quot;{{ tr('moderator_approve_confirmation' , $moderator_details->name) }}&quot;);" href="{{ route('admin.moderators.status.change', ['moderator_id' => $moderator_details->id] ) }}">{{ tr('approve') }}</a></li>
												@endif

												<li role="presentation" class="divider"></li>

												<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.moderators.redeems',['moderator_id' => $moderator_details->id] ) }}">{{ tr('redeems') }}</a></li>

												<li>

												<li role="presentation">
													<a role="menuitem" tabindex="-1" href="{{ route('admin.videos' ,['moderator_id' => $moderator_details->id] ) }}">{{ tr('videos') }}</a>
												</li>


											</ul>

										</li>

									</ul>
								</td>

							</tr>
							@endforeach
						</tbody>

					</table>

					<div align="right" id="paglink"><?php echo $moderators->appends(['search_key' => $search_key ?? "", 'sort' => $sort ?? "", 'status' => $status ?? "" ])->links(); ?></div>
					@else
					<h3 class="no-result">{{ tr('no_result_found') }}</h3>
					@endif

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
						var message = "<?php echo tr('admin_moderators_delete_confirmation') ?>";
					}else if(selected_action == 'bulk_approve'){
						var message = "<?php echo tr('admin_moderators_approve_confirmation') ?>";
					}else if(selected_action == 'bulk_decline'){
						var message = "<?php echo tr('admin_moderators_decline_confirmation') ?>";
					}
					var confirm_action = confirm(message);

					if (confirm_action == true) {
					  $( "#moderator" ).submit();
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

		localStorage.setItem("moderator_checked_items"+page, JSON.stringify(checked_ids));

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

			localStorage.setItem("moderator_checked_items"+page, JSON.stringify(checked_ids));
			get_values();
		} else {
			$("input:checkbox[name='row_check']").prop("checked", false);
			localStorage.removeItem("moderator_checked_items"+page);
			get_values();
		}

	});


	function get_values(){
		var pageKeys = Object.keys(localStorage).filter(key => key.indexOf('moderator_checked_items') === 0);
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