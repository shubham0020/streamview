@extends('layouts.admin')

@section('title', tr('users'))

@section('content-header')

@yield('title')

@endsection

@section('breadcrumb')
<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>{{ tr('home') }}</a></li>
<li><a href="{{route('admin.users.index')}}"><i class="fa fa-user"></i> {{tr('users')}}</a></li>
<li class="active"><i class="fa fa-user"></i> {{ tr('referrals') }}</li>

@endsection

@section('content')

<div class="row">

	<div class="col-xs-12">

		<div class="box box-warning">

			<div class="box-header table-header-theme">

				<b style="font-size:18px;">
					{{ tr('referrals') }}
				</b>

				<a href="{{ route('admin.users.index') }}" class="btn btn-default pull-right"><i class="fa fa-eye"></i> {{ tr('view_users') }}</a>

			</div>



			<div class="box-body">
				
				<div class="table-responsive" style="padding: 35px 0px">


				   @include('admin.users._referrals_search')

					@if(count($user_referrals) > 0)

					<div class="table table-responsive">

						<table id="example2" class="table table-bordered table-striped ">

							<thead>
								<tr>
									<th>{{ tr('id') }}</th>
									<th>{{ tr('username') }}</th>
									<th>{{ tr('referral_code') }}</th>
									<th>{{ tr('total_referrals') }}</th>
									<th>{{ tr('earnings_details') }}</th>
								</tr>

							</thead>

							<tbody>

								@foreach($user_referrals as $i => $user_referral_details)

								<tr>
									<td>{{$i+$user_referrals->firstItem()}}</td>

									<td>
										<a href="{{ route('admin.users.view' , ['user_id' => $user_referral_details->user_id] ) }}">{{ $user_referral_details->userDetails->name ?? tr('not_available') }}
										</a>
									</td>

									<td>{{ $user_referral_details->referral_code }}</td>

									<td>{{ $user_referral_details->total_referrals }}</td>

									<td>{{ formatted_amount($user_referral_details->referral_earnings ?? '0.00') }}</td>
								</tr>

								@endforeach

							</tbody>

						</table>

						<div align="right" id="paglink">{{$user_referrals->appends(['search_key' => $search_key ?? ""])->links()}}</div>

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