@extends('layouts.admin')

@section('title', tr('add_cast_crew'))

@section('content-header', tr('cast_crews'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.cast_crews.index')}}"><i class="fa fa-users"></i> {{tr('cast_crews')}}</a></li>
    <li class="active">{{tr('add_cast_crew')}}</li>
@endsection

@section('content')

    @include('admin.cast_crews._form')

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
