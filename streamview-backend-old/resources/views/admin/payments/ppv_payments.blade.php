@extends('layouts.admin')

@section('title', tr('video_payments') . ' ( '.Setting::get("currency").' '. total_video_revenue() . ' ) ' )

@section('content-header',tr('payments'))

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>{{ tr('home') }}</a></li>

	<li class="active"><i class="fa fa-credit-card"></i> {{ tr('payments') }}</li>
    <li class="active"><i class="fa fa-credit-card"></i> {{ tr('video_payments') }}</li>
@endsection

@section('content')

	<div class="row">
        <div class="col-xs-12">
          	<div class="box box-warning">
	          	<div class="box-header table-header-theme">
	                  
	                <b style="font-size:18px;">{{ tr('video_payments') }}</b>
	                <!-- EXPORT OPTION START -->

					@if(count($payments) > 0 )
	                
		                <ul class="admin-action btn btn-default pull-right" style="margin-right: 60px">
		                 	
							<li class="dropdown">
				                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
				                  {{ tr('export') }} <span class="caret"></span>
				                </a>
				                <ul class="dropdown-menu">
				                  	<li role="presentation">
				                  		<a role="menuitem" tabindex="-1" href="{{ route('admin.payperview.export' , ['format' => 'xlsx']) }}">
				                  			<span class="text-red"><b>{{ tr('excel_sheet') }}</b></span>
				                  		</a>
				                  	</li>

				                  	<li role="presentation">
				                  		<a role="menuitem" tabindex="-1" href="{{ route('admin.payperview.export' , ['format' => 'csv']) }}">
				                  			<span class="text-blue"><b>{{ tr('csv') }}</b></span>
				                  		</a>
				                  	</li>
				                </ul>
							</li>
						</ul>

					@endif

	                <!-- EXPORT OPTION END -->

	            </div>

	            <div class="box-body table-responsive">

				   @include('admin.payments._ppv_payments_search')

	            	@if(@count($payments) > 0)

		              	<table  class="table table-bordered table-striped"> 

							<thead>
							    <tr>
								  <th>{{ tr('id') }}</th>
								  <th>{{ tr('username') }}</th>
							      <th>{{ tr('video') }}</th>
							      <th>{{ tr('payment_id') }}</th>
							      <th>{{ tr('payment_mode') }}</th>
							      <th>{{ tr('paid_amount') }}</th>
	                  			  <th>{{ tr('admin') }} {{ Setting::get('currency') }}</th>
	                  			  <th>{{ tr('moderator') }} {{ Setting::get('currency') }}</th>
								  <th>{{ tr('status') }}</th>
								  <th>{{ tr('action') }}</th>
							    </tr>
							</thead>

							<tbody>

								@foreach($payments as $i => $payment_details)

								    <tr>
										<td>{{ showEntries($_GET, $i+1) }}</td>
										  
										 <td>
								      		<a href="{{ route('admin.users.view' ,['user_id' => $payment_details->user_id] ) }}"> {{ $payment_details->userVideos ? $payment_details->userVideos->name : tr('not_available') }} </a>
								      	 </td>
								      	<td>
								      		@if($payment_details->adminVideo)

								      		<a href="{{ route('admin.view.video' , array('id' => $payment_details->adminVideo->id)) }}">{{ $payment_details->adminVideo->title }}</a>

								      		@else 
								      		
								      		- 

								      		@endif

								      	</td>

								      	
								      	<td>
								      		<a href="{{route('admin.ppv_payments.view' , ['payment_id' => $payment_details->id] )}}">
											{{ $payment_details->payment_id }}
											</a>
										</td>

								      	<td class="text-capitalize">{{ $payment_details->payment_mode ? $payment_details->payment_mode : "-" }}</td>


								      	<td>{{ formatted_amount($payment_details->amount ? 
								      		$payment_details->amount : "0.00") }}</td>

								      	<td>{{ formatted_amount($payment_details->admin_amount ?
								      	 $payment_details->admin_amount : "0.00") }}</td>

								      	<td>{{ formatted_amount($payment_details->moderator_amount ? $payment_details->moderator_amount : "0.00") }}</td>
								      

								      	<td><?php //print_r($payment_details->payment_mode); ?>
								      		@if($payment_details->payment_mode != COD && $payment_details->status == 0)

								      			@if($payment_details->coupon_amount <= 0)

								      				<label class="label label-danger">{{ tr('not_paid') }}</label>

								      			@else 

								      				<label class="label label-success">{{ tr('paid') }}</label>

								      			@endif

								      		@else
								      			<label class="label label-success">{{ tr('paid') }}</label>

								      		@endif 
										  </td>
										  

										  <td>
                                           <a href="{{route('admin.ppv_payments.view' , ['payment_id' => $payment_details->id] )}}" class="btn btn-success btn-xs">{{tr('view')}}</a>
										</td>
								    </tr>					

								@endforeach
							</tbody>
						
						</table>

						<div align="right" id="paglink"><?php echo $payments->appends(request()->input())->links(); ?></div>

					@else
						<h3 class="no-result">{{ tr('no_result_found') }}</h3>
					@endif
	            </div>
          	</div>
        </div>
    </div>

@endsection

@section('scripts')

<script type="text/javascript">

$(document).ready(function() {
    $('#example3').DataTable( {
        "processing": true,
        "bLengthChange": false,
        "serverSide": true,
        "ajax": "{{ route('admin.ajax.video-payments') }}",
        "deferLoading": "{{ $payment_count > 0 ? $payment_count : 0 }}"
    } );
} );
</script>

@endsection





