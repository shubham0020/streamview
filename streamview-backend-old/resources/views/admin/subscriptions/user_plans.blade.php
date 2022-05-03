@extends('layouts.admin')

@section('title', tr('subscriptions'))

@section('content-header')

{{tr('subscription_plans')}} 

 	@if($user_details)
 		- <a  href="{{ route('admin.users.view' , ['user_id' => $user_details->id] ) }}"> {{ $user_details->name }} </a>
 	@endif

@endsection

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>{{ tr('home') }}</a></li>
     <li><a href="{{route('admin.users.index')}}"><i class="fa fa-users"></i> {{tr('users')}}</a></li>
    <li class="active"><a href="{{ route('admin.users.view' , ['user_id' => $user_id] ) }}"><i class="fa fa-user"></i> {{tr('view_user')}}</a></li>
    <li class="active"><i class="fa fa-key"></i> {{ tr('subscriptions') }}</li>
@endsection

@section('after-styles')

<style>

.subscription-image {
	overflow: hidden !important;
	position: relative !important;
	height: 15em !important;
	background-position: center !important;
	background-repeat: no-repeat !important;
	background-size: cover !important;
	margin: 0 !important;
	width: 100%;
}

.subscription-desc {
	min-height: 10em !important;
	max-height: 10em !important;
	overflow: scroll !important;
	margin-bottom: 10px !important;
}

</style>

@endsection

@section('content')
	
	<div class="row">
			
        <div class="col-xs-12">
			
          	<div class="box">

	            <div class="box-body table-responsive">

	            	@if(count($payments) > 0)

		              	<table id="example1" class="table table-bordered table-striped">

							<thead>
							    <tr>
							      <th>{{ tr('id') }}</th>
							      <th>{{ tr('username') }}</th>
							      <th>{{ tr('subscription') }}</th>
							      <th>{{ tr('payment_id') }}</th>
							      <th>{{ tr('no_of_account') }}</th>
							      <th>{{ tr('amount') }}</th>
							      <th>{{tr('subscribed_date')}}</th>
							      <th>{{ tr('expiry_date') }}</th>
							      <th>{{ tr('reason') }}</th>
							      <th>{{ tr('action') }}</th>
							    </tr>
							</thead>

							<tbody>

								@foreach($payments as $i => $payment_details)

								    <tr>
								      	<td>{{ $i+1 }}</td>

								      	<td><a href="{{ route('admin.users.view' , ['user_id' => $payment_details->user_id] ) }}"> {{ ($payment_details->user) ? $payment_details->user->name : '-' }} </a></td>

								      	<td>
								      		@if($payment_details->subscription)
								      		<a href="{{ route('admin.subscriptions.view' , ['subscription_id' => $payment_details->subscription->id] ) }}" target="_blank">{{ $payment_details->subscription ? $payment_details->subscription->title : '-' }}</a>
								      		@endif
								      	</td>

								      	<td><a href="{{route('admin.user_payments.view' , ['payment_id' => $payment_details->id] )}}">
											{{ $payment_details->payment_id }}
											</a></td>

								      	<td>{{ $payment_details->subscription ? $payment_details->subscription->no_of_account : 0 }}</td>

								      	<td>{{ formatted_amount($payment_details->amount) }}</td>

								      	<td>{{ date('d M Y',strtotime($payment_details->created_at)) }}</td>

								      	<td>{{ date('d M Y',strtotime($payment_details->expiry_date)) }}</td>

								      	<td>{{$payment_details->cancel_reason ?: tr('not_available')}}</td>

								      	<td class="text-center">

								      		@if($i == 0 && !$payment_details->is_cancelled && $payment_details->status == PAID_STATUS) 
								      		<a data-toggle="modal" data-target="#{{ $payment_details->id }}_cancel_subscription" class="pull-right btn btn-sm btn-danger">{{ tr('cancel_subscription') }}</a>

								      		@elseif($i == 0 && $payment_details->is_cancelled && $payment_details->status == PAID_STATUS)

							      				<?php $enable_subscription_notes = tr('enable_subscription_notes') ; ?>
							      			
							      				<a onclick="return confirm('{{ $enable_subscription_notes }}')" href="{{ route('admin.subscriptions.enable', ['user_id' => $payment_details->user_id]) }}" class="pull-right btn btn-sm btn-success">{{ tr('enable_subscription') }}</a>

							      			@else
							      				-		
								      		@endif
								      	</td>

								    </tr>

						            <div class="modal fade error-popup" id="{{ $payment_details->id }}_cancel_subscription" role="dialog">

						                <div class="modal-dialog">

						                    <div class="modal-content">

						                   		<form method="post" action="{{ route('admin.subscriptions.cancel', ['user_id' => $payment_details->user_id]) }}">
						                   			@csrf
							                        <div class="modal-body">

							                            <div class="media">

							                        		<div class="media-body">

							                                   <h4 class="media-heading">{{ tr('reason') }} *</h4>

							                                   <textarea rows="5" name="cancel_reason" id='cancel_reason' required style="width: 100%"></textarea>

							                               </div>

							                            </div>

							                            <div class="text-right">

							                           		<br>

							                               <button type="submit" class="btn btn-primary top">{{ tr('submit') }}</button>

							                           </div>

							                        </div>

						                        </form>

						                    </div>

						                </div>

						            </div>

								@endforeach

							</tbody>

						</table>

						<div>
							
						</div>

					@else
						<h3 class="no-result">{{ tr('no_subscription_found') }}</h3>
					@endif

	            </div>

          	</div>

        </div>
    
    </div>

	<div class="row">

		<div class="col-md-12">

			<div class="row">

				@if(count($subscriptions) > 0)

					@foreach($subscriptions as $s => $subscription_details)

						<div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">

							<div class="thumbnail">

								<div class="caption">

									<h3>
										<a href="{{ route('admin.subscriptions.view' , ['subscription_id' => $subscription_details->id] ) }}" target="_blank">{{ $subscription_details->title }}</a>
									</h3>

									<hr>

									<h4>{{ $subscription_details->no_of_account > 1 ? tr('no_of_accounts'):tr('no_of_account') }}<b class="pull-right">{{ $subscription_details->no_of_account }}</b></h4>

									<!-- <div class="text-success"></div> -->

									
									<!-- <h4></h4> -->

									<div class="subscription-desc">

									    <b>{{ tr('description') }} : </b>

										<?php echo $subscription_details->description; ?>

									</div>

									<br>

									<p>
										<span class="btn btn-danger pull-left" style="cursor: default;">{{  Setting::get('currency') }} {{ $subscription_details->amount }} / {{ $subscription_details->plan }} M</span>

										<a href="{{ route('admin.users.subscriptions.save' , ['subscription_id' => $subscription_details->id, 'user_id' => $user_id]) }}" class="btn btn-success pull-right">{{ tr('choose') }}</a>
									</p>
									<br>
									<br>
								</div>
							
							</div>
						
						</div>

					@endforeach

				@endif
				
			</div>
		</div>
	
	</div>

@endsection