@extends('layouts.admin')

@section('title', tr('subscriptions'))

@section('content-header', tr('subscriptions'))

@section('breadcrumb')
<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>{{ tr('home') }}</a></li>
<li><a href="{{route('admin.subscriptions.index')}}"><i class="fa fa-key"></i> {{tr('subscriptions')}}</a></li>
<li class="active"><i class="fa fa-key"></i> {{ tr('view_subscriptions') }}</li>
@endsection

@section('content')

<div class="row">

	<div class="col-xs-12">

		<div class="box box-warning">

			<div class="box-header table-header-theme">
				<b class="sub_heading_css">{{ tr('view_subscriptions') }}</b>
				<a href="{{ route('admin.subscriptions.create') }}" style="float:right" class="btn btn-default"><i class="fa fa-plus"></i> {{ tr('add_subscription') }}</a>
			</div>

			<div class="box-body">

				@include('admin.subscriptions._search')


				<div class="table table-responsive ">

					<table class="table table-bordered table-striped table-top">

						<thead>
							<tr>
								<th>{{ tr('id') }}</th>
								<th>{{ tr('title') }}</th>
								<th>{{ tr('no_of_months') }}</th>
								<th>{{ tr('amount') }}</th>
								<th>{{ tr('status') }}</th>
								<th>{{ tr('popular') }}</th>
								<th>{{ tr('no_of_accounts') }}</th>
								<th>{{ tr('subscribers') }}</th>
								<th>{{ tr('action') }}</th>
							</tr>
						</thead>

						<tbody>

							@foreach($subscriptions as $i => $subscription_details)

							<tr>
								<td>{{ showEntries($_GET, $i+1) }}</td>

								<td><a href="{{ route('admin.subscriptions.view' , ['subscription_id' => $subscription_details->id] ) }}">{{ $subscription_details->title }}</a></td>

								<td>{{ $subscription_details->plan }}</td>

								<td>{{ Setting::get('currency' , "$") }} {{ $subscription_details->amount }}</td>

								<td class="btn-left">

									@if($subscription_details->status)
									<span class="label label-success">{{ tr('approved') }}</span>
									@else
									<span class="label label-warning">{{ tr('pending') }}</span>
									@endif
								</td>

								<td class="btn-left">
									@if($subscription_details->popular_status)

									<a href="{{ route('admin.subscriptions.popular.status' , ['subscription_id' => $subscription_details->id] ) }}" class="btn  btn-xs btn-danger">
										{{ tr('remove_popular') }}
									</a>
									@else

									<a href="{{ route('admin.subscriptions.popular.status' , ['subscription_id' => $subscription_details->id] ) }}" class="btn  btn-xs btn-success">
										{{ tr('mark_popular') }}
									</a>
									@endif
								</td>

								<td>{{ $subscription_details->no_of_account }}</td>

								<td>

									@if($subscription_details->subscribers_count >=1)

									@php($url = route('admin.subscriptions.users' , ['subscription_id' => $subscription_details->id] ))

									@else

									@php($url = 'javascript:void(0)')

									@endif

									<a class="btn btn-sm btn-success" href="{{$url}}">
										<span class="text-white">{{ $subscription_details->subscribers_count ?? 0 }}</span>
									</a>

								</td>

								<td>

									<ul class="admin-action btn btn-default">

										<li class="dropdown">

											<a class="dropdown-toggle" data-toggle="dropdown" href="#">
												{{ tr('action') }} <span class="caret"></span>
											</a>

											<ul class="dropdown-menu dropdown-menu-right">

												<li role="presentation">
													<a role="menuitem" tabindex="-1" href="{{ route('admin.subscriptions.view' , ['subscription_id' => $subscription_details->id] ) }}"><span class="text-blue"><b><i class="fa fa-eye"></i>&nbsp;{{ tr('view') }}</b></span>
													</a>
												</li>


												@if(Setting::get('admin_delete_control') == YES )

												<li role="presentation"><a role="button" href="javascript:;" class="btn disabled" style="text-align: left"><i class="fa fa-trash"></i>&nbsp;{{ tr('delete') }}</a></li>

												<li role="presentation">
													<a role="menuitem" tabindex="-1" href="javascript:;"><i class="fa fa-edit"></i>&nbsp;{{ tr('edit') }}
													</a>
												</li>

												@else

												<li role="presentation"><a role="menuitem" tabindex="-1" onclick="return confirm(&quot;{{ tr('subscription_delete_confirmation' , $subscription_details->title) }}&quot;)" href="{{ route('admin.subscriptions.delete', ['subscription_id' => $subscription_details->id] ) }}"><i class="fa fa-trash"></i>&nbsp;{{ tr('delete') }}</a></li>

												<li role="presentation">
													<a role="menuitem" tabindex="-1" href="{{ route('admin.subscriptions.edit' , ['subscription_id' => $subscription_details->id] ) }}"><i class="fa fa-edit"></i>&nbsp;{{ tr('edit') }}
													</a>
												</li>

												@endif

												<li role="presentation" class="divider"></li>

												<li role="presentation">
													<a role="menuitem" tabindex="-1" href="{{ route('admin.subscriptions.users' , ['subscription_id' => $subscription_details->id] ) }}">
														<span class="text-green"><b><i class="fa fa-user"></i>&nbsp;{{ tr('subscribers') }}</b></span>
													</a>
												</li>

												<li role="presentation" class="divider"></li>

												@if($subscription_details->status == APPROVED )

												<li role="presentation">
													<a role="menuitem" tabindex="-1" onclick="return confirm(&quot;{{ tr('subscription_decline_confirmation' , $subscription_details->title) }}&quot;)" href="{{ route('admin.subscriptions.status.change' , ['subscription_id' => $subscription_details->id] ) }}">
														<span class="text-red"><b><i class="fa fa-close"></i>&nbsp;{{ tr('decline') }}</b></span>
													</a>
												</li>

												@else

												<li role="presentation">
													<a role="menuitem" tabindex="-1" onclick="return confirm(&quot;{{ tr('subscription_approve_confirmation' , $subscription_details->title) }}&quot;)" href="{{ route('admin.subscriptions.status.change' ,  ['subscription_id' => $subscription_details->id] ) }}">
														<span class="text-green"><b><i class="fa fa-check"></i>&nbsp;{{ tr('approve') }}</b></span>
													</a>
												</li>

												@endif
												<li role="presentation" class="divider"></li>

											</ul>

										</li>

									</ul>

								</td>
							</tr>

							@endforeach

						</tbody>

					</table>
				</div>

				@if(count($subscriptions) > 0) <div align="right" id="paglink"><?php echo $subscriptions->appends(['status'=>Request::get('status')??''])->links(); ?></div> @endif

			</div>

		</div>

	</div>

</div>

@endsection