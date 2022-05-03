@extends('layouts.admin')

@section('title', tr('edit_language'))

@section('content-header', tr('edit_language'))

@section('breadcrumb')
    <li><a href="{{route('admin.languages.index')}}"><i class="fa fa-globe"></i>{{tr('languages')}}</a></li>
    <li class="active"><i class="fa fa-globe"></i>&nbsp; {{tr('edit_language')}}</li>
@endsection

@section('styles')

    <link rel="stylesheet" href="{{asset('common/css/imageHover.css')}}">

@endsection

@section('content')

  	<div class="row">

	    <div class="col-md-10">
    		
	        <div class="box box-warning">

	            <div class="box-header table-header-theme">
	                <b>{{tr('edit_language')}}</b>
	                <a href="{{ (Setting::get('admin_delete_control')) ? '#' : route('admin.languages.index')}}" style="float:right" class="btn btn-default">{{tr('languages')}}</a>
	            </div>

	            @include('admin.languages._form')

	        </div>

	    </div>

	</div>
   
@endsection

