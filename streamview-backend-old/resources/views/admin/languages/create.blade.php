@extends('layouts.admin')

@section('title', tr('create_language'))

@section('content-header', tr('languages'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.languages.index')}}"><i class="fa fa-globe"></i>{{tr('languages')}}</a></li>
    <li class="active"><i class="fa fa-globe"></i>&nbsp; {{tr('create_language')}}</li>
@endsection

@section('content')

  	<div class="row">

	    <div class="col-md-10">
    		
	        <div class="box box-warning">

	            <div class="box-header table-header-theme">
	                <h2 class="box-title"> <b>{{tr('create_language')}}</b></h2>
	                <a href="{{ route('admin.languages.index') }}" style="float:right" class="btn btn-default">{{tr('view_languages')}}</a>
	            </div>

	            @include('admin.languages._form')

	        </div>

	    </div>

	</div>
   
@endsection

