@extends('layouts.admin')

@section('title', tr('add_video'))

@section('content-header', tr('add_video'))

@section('breadcrumb')
    
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>{{ tr('home') }}</a></li>
    
    <li class="active"><i class="fa fa-users"></i> {{ tr('cast_crews') }}</li>
    
@endsection

@section('styles')
<style>
	.bar {
	    height: 18px;
	    background: green;
	}
</style>
@endsection

@section('content')

	<div class="row">

        <div class="col-xs-12">

        	<div class="box box-warning">

	            <div class="box-header table-header-theme">
	                <b style="font-size:18px;">@yield('title')</b>
	                <a href="{{ route('admin.cast_crews.index') }}" class="btn btn-default pull-right">{{ tr('view_cast_crews') }}</a>
	            </div>

	            <form class="form-horizontal" action="{{route('videos_save')}}" method="POST" enctype="multipart/form-data" role="form">
	                @csrf
	                <div class="box-body">

	                	<div class="form-group col-xs-6">

	                		<label>{{tr('video')}}</label>

	        				<input id="video" class="form-control" data-url="{{route('videos_save')}}" type="file" accept="video/*" name="video">
	        			</div>

	        			<div id="progress">
						    <div class="bar" style="width: 0%;"></div>
						</div>

	        		</div>
	        		<div class="box-footer">
	        			<button id="upload-video" data-url="{{route('videos_save')}}" class="btn btn-success">Upload</button>
	        		</div>
	        	</form>
        	</div>

        </div>

    </div>

@endsection

@section('scripts')

<script src="{{asset('admin-css/upload-video/js/vendor/jquery.ui.widget.js')}}"></script>

<script src="{{asset('admin-css/upload-video/js/jquery.iframe-transport.js')}}"></script>

<script src="{{asset('admin-css/upload-video/js/jquery.fileupload.js')}}"></script>

<script>
$(function () {
    $('#upload-video').fileupload({
        dataType: 'json',
        progressall: function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        	$('#progress .bar').css(
	            'width',
	            progress + '%'
	        );
	    },
        done: function (e, data) {
        }
    });
});
</script>

@endsection
