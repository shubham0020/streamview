@extends('layouts.admin')

@section('title', tr('pages'))

@section('content-header', tr('pages'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.pages.index')}}"><i class="fa fa-book"></i> {{tr('pages')}}</a></li>
    <li class="active"> {{tr('add_page')}}</li>
@endsection

@section('content')

  	<div class="row">

	    <div class="col-md-10">

	        <div class="box box-warning">

	            <div class="box-header table-header-theme">

	                <b>{{tr('add_page')}}</b>
	                <a href="{{route('admin.pages.index')}}" style="float:right" class="btn btn-default"> <i class="fa fa-eye"></i>  {{tr('view_pages')}}</a>
	            </div>

	            @include('admin.pages._form')

	        </div>

	    </div>

	</div>
   
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'ckeditor' );

		$("form").submit( function(e) {

		var messageLength = CKEDITOR.instances['ckeditor'].getData().replace(/<[^>]*>/gi, '').length;

		if( !messageLength ) {

			alert( 'Please enter a description' );

			e.preventDefault();

		}

		});
    </script>
@endsection


