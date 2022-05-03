@extends('layouts.admin')

@section('title', tr('video_payments'))

@section('content-header',tr('payments') ) 

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="#"><i class="fa fa-money"></i> {{tr('payments')}}</a></li>
    <li class="active"><i class="fa fa-credit-card"></i> {{tr('video_payments')}}</li>
@endsection

@section('content')


	<div class="row">

		<div class="col-md-10 col-md-offset-1">

    		<div class="box box-widget widget-user-2">

            	<div class="widget-user-header bg-gray">

            		<div class="pull-left">
	              		
	              		<h3 class="widget-user-username"></h3>
	      				<h5 class="widget-user-desc"> <i class="fa fa-credit-card"></i> {{tr('video_payments')}}</h5>
      				</div>

      				<div class="clearfix"></div>
            	</div>	
            	
            	<div class="box-footer no-padding">
            		
            		<div class="col-md-6">

                       <ul class="nav nav-stacked">
                            <li>
                                <a href="{{route('admin.users.view',['user_id'=>$payment_details->user_id])}}">{{tr('username')}} 
                                    <span class="text-green pull-right"><b>{{$payment_details->user_name}}</b></span>
                                </a>
                            </li>
			                <li><a>{{tr('email')}} <span class="pull-right">{{$payment_details->email ?: tr('not_available')}}</span></a></li>
			                <li><a>{{tr('mobile')}} <span class="pull-right">{{$payment_details->mobile ?: tr('not_available')}}</span></a></li>
                             
                            
                            <li>
			                	<a href="{{ route('admin.view.video' , ['id' => $payment_details->adminVideo->id]) }}">{{tr('video')}} 
			                		<span class="text-green pull-right"><b>{{$payment_details->video_name}}</b></span>
                                         
			                        </span>
			                    </a>    
                            </li>
                            
                            <li>
			                	<a>{{tr('payment_id')}} 
			                		<span class="pull-right"> 
                                        {{$payment_details->payment_id}}
			                        </span>
			                    </a>    
                            </li>
                            
                            <li>
			                	<a>{{tr('payment_mode')}} 
			                		<span class="pull-right text-capitalize"> 
                                    {{$payment_details->payment_mode ?? 'free-plan'}}
			                        </span>
			                    </a>    
                            </li>

                            <li>
			                	<a>{{tr('ppv_amount')}} 
			                		<span class="pull-right"> 
                                    {{ formatted_amount($payment_details->ppv_amount ?? "0.00") }}
			                        </span>
			                    </a>    
                            </li>

                            <li>
			                	<a>{{ tr('admin') }} 
			                		<span class="pull-right"> 
                                    {{ formatted_amount($payment_details->admin_amount ?? "0.00") }}
			                        </span>
			                    </a>    
                            </li>

                            <li>
			                	<a>{{ tr('moderator') }} 
			                		<span class="pull-right"> 
                                    {{ formatted_amount($payment_details->moderator_amount ?? "0.00") }}
			                        </span>
			                    </a>    
                            </li>

                            <li>
			                	<a>{{tr('coupon_code')}} 
			                		<span class="pull-right"> 
                                    {{$payment_details->coupon_code ?: tr('not_added')}}
			                        </span>
			                    </a>    
                            </li>

                            
                            <li>
			                	<a>{{tr('paid_amount')}} 
			                		<span class="pull-right"> 
                                    {{formatted_amount($payment_details->amount ?? "0.00")}}
			                        </span>
			                    </a>    
			                </li>
                       </ul>
                          
            		</div>

	            	<div class="col-md-6">

                       <ul class="nav nav-stacked">   
                        
                           <li>
			                	<a>{{tr('coupon_amount')}} 
			                		<span class="pull-right"> 
                                    {{formatted_amount($payment_details->coupon_amount ?? "0.00")}}
			                        </span>
			                    </a>    
                            </li>

                            <li>
			                	<a>{{tr('referral_amount')}} 
			                		<span class="pull-right"> 
                                    {{formatted_amount($payment_details->wallet_amount ?? "0.00")}}
			                        </span>
			                    </a>    
                            </li>
                    
                            <li>
                                <a>{{tr('is_coupon_applied')}} <span class="pull-right">
                                    @if($payment_details->is_coupon_applied)
                                    <span class="label label-success">{{tr('yes')}}</span>
                                    @else
                                    <span class="label label-danger">{{tr('no')}}</span>
                                    @endif
                                </span>
                                </a>
                            </li>

                            <!-- <li>
                                <a>{{tr('coupon_reason')}} 
                                    <span class="pull-right">
                                    {{$payment_details->coupon_reason ?:'-'}}
                                </span>
                                </a>
                            </li> -->
	            			
                            <li>
                                <a>{{tr('is_referral_applied')}} <span class="pull-right">
                                    @if($payment_details->is_wallet_credits_applied)
                                    <span class="label label-success">{{tr('yes')}}</span>
                                    @else
                                    <span class="label label-danger">{{tr('no')}}</span>
                                    @endif
                                </span>
                                </a>
                            </li>

                            <li>
                                <a>{{tr('status')}} 
                                    <span class="pull-right">
                                        @if($payment_details->status)
                                        <span class="label label-success">{{tr('paid')}}</span>
                                        @else
                                        <span class="label label-danger">{{tr('not_paid')}}</span>
                                        @endif
                                    </span>
                                </a>
                            </li>

                            <li>
                            <a>{{tr('paid_date')}} 
                                <span class="pull-right">
                                    {{ common_date($payment_details->created_at,Auth::guard('admin')->user()->timezone) }}
                                </span>
                            </a>
                        </li>
<!-- 
                            <li>
                                <a>{{tr('expiry_date')}} 
                                    <span class="pull-right">
                                    {{ common_date($payment_details->expiry_date,Auth::guard('admin')->user()->timezone,'d M Y') }}
                                    </span>
                                </a>
                            </li> -->
			              
                        </ul>
	            	</div>
          	
          		</div>

            
          	
          	</div>

		</div>

    </div>

@endsection


