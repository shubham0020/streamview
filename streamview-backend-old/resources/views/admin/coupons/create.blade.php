@extends('layouts.admin')

@section('title',tr('add_coupon'))

@section('content-header',tr('coupons'))

@section('breadcrumb')

	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>

	<li><a href="{{route('admin.coupons.index')}}"><i class="fa fa-gift"></i>{{tr('coupons')}}</a></li>

	<li class="active">{{tr('add_coupon')}}</li>

@endsection

@section('content')

	<div class="row">

		<div class="col-md-10">

			<div class="box box-warning">

				<div class="box-header table-header-theme">

					<b style="font-size: 18px">{{tr('add_coupon')}}</b>

					<a href="{{route('admin.coupons.index')}}" class="btn btn-default pull-right"><i class="fa fa-eye"></i>{{tr('view_coupons')}}</a>

				</div>

				@include('admin.coupons._form')

			</div>

		</div>

	</div>
	
@endsection