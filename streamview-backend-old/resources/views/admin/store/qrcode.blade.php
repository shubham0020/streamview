@extends('layouts.admin')

@section('title', tr('sub_admin_view'))

@section('content-header', tr('sub_admin_view'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <!-- <li><a href="{{route('admin.store.index')}}"><i class="fa fa-user"></i> {{tr('store')}}</a></li> -->
    <li class="active"><i class="fa fa-support"></i> {{tr('sub_admin_view')}}</li>
@endsection

@section('content')

	<style type="text/css">
		.timeline::before {
		    content: '';
		    position: absolute;
		    top: 0;
		    bottom: 0;
		    width: 0;
		    background: #fff;
		    left: 0px;
		    margin: 0;
		    border-radius: 0px;
		}
	</style>

	
    
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Scan QR Code to verify Payment</h3>
            </div>
            <div class="card-body">
                {!! QrCode::size(300)->generate($admin_details1) !!}
            </div>
        </div>
        <!-- <div class="card">
            <div class="card-header">
                <h2>Color QR Code</h2>
            </div>
            <div class="card-body">
                {!! QrCode::size(300)->backgroundColor(255,90,0)->generate('RemoteStack') !!}
            </div>
        </div> -->
    </div>

    


@endsection