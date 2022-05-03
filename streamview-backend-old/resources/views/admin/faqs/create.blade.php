@extends('layouts.admin')

@section('title', tr('faqs'))

@section('content-header', tr('faqs'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.faqs.index')}}"><i class="fa fa-book"></i> {{tr('faqs')}}</a></li>
    <li class="active"> {{tr('add_faq')}}</li>
@endsection

@section('content')

  	<div class="row">

	    <div class="col-md-10">

	        <div class="box box-warning">

	            <div class="box-header table-header-theme">
	                <b>{{tr('add_faq')}}</b>
	                <a href="{{route('admin.faqs.index')}}" style="float:right" class="btn btn-default">{{tr('view_faqs')}}</a>
	            </div>

	            @include('admin.faqs._form')

	        </div>

	    </div>

	</div>
   
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'ckeditor' );
    </script>
@endsection


