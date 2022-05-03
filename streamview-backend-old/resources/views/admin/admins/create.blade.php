@extends('layouts.admin')

@section('title', tr('create_admin'))

@section('content-header', tr('create_admin'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.admins.index')}}"><i class="fa fa-user"></i> {{tr('admins')}}</a></li>
    <li class="active"><i class="fa fa-user-plus"></i> {{tr('create_admin')}}</li>
@endsection

@section('content')

	@include('admin.admins._form')

@endsection

@section('scripts')

<script src="{{asset('assets/js/jstz.min.js')}}"></script>
<script>
    
    $(document).ready(function() {

        var dMin = new Date().getTimezoneOffset();
        var dtz = -(dMin/60);
        // alert(dtz);
        $("#userTimezone").val(jstz.determine().name());
    });

</script>

@endsection