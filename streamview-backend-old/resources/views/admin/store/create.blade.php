@extends('layouts.admin')

@section('title', tr('store_create'))

@section('content-header', tr('sub_admins'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.store.index')}}"><i class="fa fa-support"></i> Store Users<!--{{tr('store_users')}}--></a></li>
    <li class="active"><i class="fa fa-support"></i> Store User Create<!--{{tr('store_create')}}--></li>
@endsection

@section('content')

@include('admin.store._form')

@endsection

@section('scripts')

<script src="{{asset('assets/js/jstz.min.js')}}"></script>

<script>
    
    $(document).ready(function() {

        var dMin = new Date().getTimezoneOffset();
        
        var dtz = -(dMin/60);
        
        $("#userTimezone").val(jstz.determine().name());

    });

</script>

<script src="{{asset('admin-css/plugins/iCheck/icheck.min.js')}}"></script>

@endsection