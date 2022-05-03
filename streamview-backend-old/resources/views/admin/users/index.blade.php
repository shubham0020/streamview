@extends('layouts.admin')

@section('title', $title)

@section('content-header')

@if(Request::get('subscription_id'))

{{ tr('subscriptions') }}

@else

{{ tr('users') }}

<a href="#" id="help-popover" class="btn btn-danger" style="font-size: 14px;font-weight: 600" title="{{ tr('any_help') }}">{{ tr('help_ques_mark') }}
</a>

<div id="help-content" style="display: none">

	<ul class="popover-list">
		<li><span class="text-green"><i class="fa fa-check-circle"></i></span> - {{ tr('paid_subscribed_users') }}</li>
		<li><span class="text-red"><i class="fa fa-times"></i></span> -{{ tr('unpaid_unsubscribed_user') }}</li>
		<li><b>{{ tr('validity_days') }} - </b>{{ tr('expiry_days_subscription_user') }}</li>
		<li><b>{{ tr('upgrade') }} - </b>{{ tr('admin_moderator_upgrade_option') }}</li>
	</ul>

</div>

@endif
@endsection

@section('breadcrumb')

@if(Request::get('subscription_id'))

<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>{{ tr('home') }}</a></li>
<li><a href="{{route('admin.subscriptions.index')}}"><i class="fa fa-key"></i> {{tr('subscriptions')}}</a></li>
<li class="active"><i class="fa fa-key"></i> {{ tr('view_subscriptions') }}</li>

@else

<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>{{ tr('home') }}</a></li>
<li class="active"><i class="fa fa-user"></i> {{ tr('users') }}</li>
<li class="active"><i class="fa fa-user"></i> {{ Request::get('sort') ? tr('declined_users'):tr('view_users') }} </li>

@endif
@endsection

@section('content')

<div class="row">

	<div class="col-xs-12">

		<div class="box box-warning">

			<div class="box-header table-header-theme">

				<b style="font-size:18px;">
					@yield('title') @if(isset($subscription))-
					<a style="color: white;text-decoration: underline;" href="{{ route('admin.subscriptions.view' ,['subscription_id' => $subscription->id] ) }}">
						{{ $subscription->title  }}
					</a>@endif
				</b>

				<a href="{{ route('admin.users.create') }}" class="btn btn-default pull-right"><i class="fa fa-plus"></i> {{ tr('add_user') }}</a>

				<!-- EXPORT OPTION START -->

				@if(count($users) > 0 )

				<ul class="admin-action btn btn-default pull-right" style="margin-right: 20px">

					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							{{ tr('export') }} <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li role="presentation">
								<a role="menuitem" tabindex="-1" href="{{ route('admin.users.export' , ['format' => 'XLSX', 'sort'=> Request::get('sort'), 'subscription_id'=>Request::get('subscription_id')]) }}">
									<span class="text-red"><b>{{ tr('excel_sheet') }}</b></span>
								</a>
							</li>

							<li role="presentation">
								<a role="menuitem" tabindex="-1" href="{{ route('admin.users.export' , ['format' => 'csv', 'sort'=> Request::get('sort'), 'subscription_id'=>Request::get('subscription_id')]) }}">
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

	            <div class="bulk_action">

				<form  action="{{route('admin.users.bulk_action')}}" id="users_form" method="POST" role="search">

					@csrf

					<input type="hidden" name="action_name" id="action" value="">

					<input type="hidden" name="selected_users" id="selected_ids" value="">

					<input type="hidden" name="page_id" id="page_id" value="{{ (request()->page) ? request()->page : '1' }}">

				</form>
			</div>

				<!-- EXPORT OPTION END -->

			</div>

			<div class="box-header text-center">
				<span class="col-sm-4">
					<h4>{{tr('total_users')}} : {{ $users->total_users }}</h4>
				</span>
				<span class="col-sm-4">
					<h4>{{tr('total_approved')}} : {{ $users->total_approved }}</h4>
				</span>
				<span class="col-sm-4">
					<h4>{{tr('total_declined')}} : {{ $users->total_declined }}</h4>
				</span>

				@include('admin.users._search')
				
			</div>

			<div class="card-body">

				<div class="table-responsive">

					@if(@count($users) > 0)

					<div class="table table-responsive">

						<table id="example2" class="table table-bordered table-striped ">

							<thead>
								<tr>
									<th>
								    		<input id="check_all" type="checkbox">
								    </th>
									<th>{{ tr('s_no') }}</th>
									<th>{{ tr('username') }}</th>
									<th>{{ tr('email') }}</th>
									<th>{{ tr('mobile') }}</th>
									<th>{{ tr('upgrade') }}</th>
									<th>{{ tr('active_plan') }}</th>
									<th>{{ tr('sub_profiles') }}</th>
									<th>{{ tr('clear_login') }}</th>
									<th>{{ tr('status') }}</th>
									<th>{{ tr('action') }}</th>
								</tr>

							</thead>

							<tbody>

								@foreach($users as $i => $user_details)

								<tr>
									<td><input type="checkbox" name="row_check" class="faChkRnd" id="{{$user_details->id}}" value="{{$user_details->id}}"></td>

									<td>{{$i+$users->firstItem()}}</td>

									<td>
										<a href="{{ route('admin.users.view' , ['user_id' => $user_details->id] ) }}">{{ $user_details->name }}

											@if($user_details->user_type)

											<span class="text-green pull-right"><i class="fa fa-check-circle"></i></span>

											@else

											<span class="text-red pull-right"><i class="fa fa-times"></i></span>

											@endif
										</a>
									</td>

									<td>{{ $user_details->email ?:tr('not_available') }}</td>

									<td>{{ $user_details->mobile ?: tr('not_available')}}</td>

									<td>
										@if($user_details->is_moderator)
										<a onclick="return confirm(&quot;{{ tr('disable_user_to_moderator',$user_details->name) }}&quot;);" href="{{ route('admin.users.upgrade.disable' , ['user_id' => $user_details->id, 'moderator_id' => $user_details->moderator_id] ) }}" class="label label-warning" title="{{  tr('admin_user_remove_moderator_role')  }}">{{ tr('disable') }}</a>
										@else
										<a onclick="return confirm(&quot;{{ tr('upgrade_user_to_moderator',$user_details->name) }}&quot;);" href="{{ route('admin.users.upgrade' , ['user_id' => $user_details->id ] ) }}" class="label label-danger" title="{{ tr('admin_user_change_to_moderator_role') }}">{{ tr('upgrade') }}</a>
										@endif

									</td>

									<td class="text-center">
										@if($subscription_details)
										{{$subscription_details->title}}
										@else
										<?php echo active_plan($user_details->id); ?>

										@if($user_details->user_type)
										<br>
										({{ get_expiry_days($user_details->id) }} days)
										@endif
										@endif

									</td>

									<td>
										<a role="menuitem" tabindex="-1" href="{{ route('admin.users.subprofiles',['user_id' => $user_details->id ] ) }}"><span class="label label-primary">
											@if($user_details->subProfile->count() > 1)
												{{ $user_details->subProfile ? count($user_details->subProfile) : 0 }} {{ tr('sub_profiles') }}
											@else
												{{ $user_details->subProfile ? count($user_details->subProfile) : 0 }} {{ tr('sub_profile') }}
											@endif
										</span>
										</a>
									</td>
									<td class="text-center">

										<a href="{{ route('admin.users.clear-login',['user_id' => $user_details->id ] ) }}"><span class="label label-warning">{{ tr('clear') }}</span></a>

									</td>

									<td>
										@if($user_details->is_activated)

										<span class="label label-success">{{ tr('approved') }}</span>

										@else

										<span class="label label-warning">{{ tr('declined') }}</span>

										@endif

									</td>

									<td>

										<ul class="admin-action btn btn-default">

											<li class="@if($i < 5) dropdown @else dropup @endif">

												<a class="dropdown-toggle" data-toggle="dropdown" href="#">
													{{ tr('action') }} <span class="caret"></span>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">

													<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.users.view' , ['user_id' => $user_details->id ] ) }}">{{ tr('view') }}</a></li>

													@if(Setting::get('admin_delete_control') == YES )

													<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;">{{ tr('edit') }}</a></li>

													@if(get_expiry_days($user_details->id) > 0)

													<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;">{{ tr('delete') }}
														</a></li>

													@else

													<li role="presentation"><a role="menuitem" tabindex="-1" onclick="return confirm(&quot;{{ tr('admin_user_delete_confirmation' , $user_details->name) }}&quot;);" href="javascript:;">{{ tr('delete') }}
														</a></li>

													@endif

													<li role="presentation" class="divider"></li>
													@else

													<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.users.edit' , ['user_id' => $user_details->id ] ) }}">{{ tr('edit') }}</a></li>

													<li>
														@if(get_expiry_days($user_details->id) > 0)

														<a role="menuitem" tabindex="-1" onclick="return confirm(&quot;{{ tr('admin_user_delete_with_expiry_days_confirmation' , get_expiry_days($user_details->id ) ) }}&quot;);" href="{{ route('admin.users.delete', ['user_id' => $user_details->id ]) }}">{{ tr('delete') }}
														</a>

														@else

														<a role="menuitem" tabindex="-1" onclick="return confirm(&quot;{{ tr('admin_user_delete_confirmation' , $user_details->name) }}&quot;);" href="{{ route('admin.users.delete', ['user_id' => $user_details->id ] ) }}">{{ tr('delete') }}
														</a>

														@endif
													</li>

													<li role="presentation" class="divider"></li>
													@endif

													@if($user_details->is_activated)
													<li role="presentation"><a role="menuitem" onclick="return confirm(&quot;{{  $user_details->name  }} - {{ tr('user_decline_confirmation') }}&quot;);" tabindex="-1" href="{{ route('admin.users.status.change' , ['user_id' => $user_details->id ] ) }}"> {{ tr('decline') }}</a></li>
													@else
													<li role="presentation"><a role="menuitem" onclick="return confirm(&quot;{{ $user_details->name }} - {{ tr('user_approve_confirmation') }}&quot;);" tabindex="-1" href="{{ route('admin.users.status.change' , ['user_id' => $user_details->id ] ) }}">
															{{ tr('approve') }} </a></li>
													@endif

													@if(!$user_details->is_verified)

													<li role="presentation" class="divider"></li>
													<li role="presentation">
														<a role="menuitem" tabindex="-1" href="{{ route('admin.users.verify' , ['user_id' => $user_details->id ] ) }}">{{ tr('verify') }}</a>
													</li>
													@endif

													<li role="presentation" class="divider"></li>

													<li role="presentation">
														<a role="menuitem" tabindex="-1" href="{{ route('admin.users.subprofiles',  ['user_id' => $user_details->id ] ) }}">{{ tr('sub_profiles') }}</a>
													</li>

													<li role="presentation">
														<a role="menuitem" tabindex="-1" href="{{ route('admin.users.videos.downloaded', ['user_id' => $user_details->id, 'downloaded' => ENABLED_DOWNLOAD] ) }}">{{ tr('downloaded_videos') }}</a>
													</li>

													<li role="presentation" class="divider"></li>

													<li>
														<a href="{{ route('admin.subscriptions.plans' , ['user_id' => $user_details->id] ) }}">
															<span class="text-green"><b><i class="fa fa-eye"></i>&nbsp;{{ tr('subscription_plans') }}</b></span>
														</a>

													</li>

													<!-- <li role="presentation" class="divider"></li>

																<li>
																	<a href="{{route('admin.users.wallet' , $user_details->id)}}">		
																		<span class="text-red"><b><i class="fa fa-eye"></i>&nbsp;{{tr('referrals')}}</b></span>
																	</a>

																</li> -->

												</ul>

											</li>

										</ul>

									</td>

								</tr>

								@endforeach

							</tbody>

						</table>

						<div align="right" id="paglink">{{$users->appends(['search_key' => $search_key ?? "", 'sort' => $sort ?? "",'status'=>Request::get('status') ?? '','subscription_id'=>Request::get('subscription_id') ?? ''])->links()}}</div>

					</div>

					@else
					<h3 class="no-result">{{ tr('no_user_found') }}</h3>
					@endif

				</div>

			</div>

		</div>

	</div>

</div>

@endsection

@section('scripts')
    
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
						var message = "<?php echo tr('admin_users_delete_confirmation') ?>";
					}else if(selected_action == 'bulk_approve'){
						var message = "<?php echo tr('admin_users_approve_confirmation') ?>";
					}else if(selected_action == 'bulk_decline'){
						var message = "<?php echo tr('admin_users_decline_confirmation') ?>";
					}
					var confirm_action = confirm(message);

					if (confirm_action == true) {
					  $( "#users_form" ).submit();
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

		localStorage.setItem("user_checked_items"+page, JSON.stringify(checked_ids));

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

			localStorage.setItem("user_checked_items"+page, JSON.stringify(checked_ids));
			get_values();
		} else {
			$("input:checkbox[name='row_check']").prop("checked", false);
			localStorage.removeItem("user_checked_items"+page);
			get_values();
		}

	});


	function get_values(){
		var pageKeys = Object.keys(localStorage).filter(key => key.indexOf('user_checked_items') === 0);
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

@endsection