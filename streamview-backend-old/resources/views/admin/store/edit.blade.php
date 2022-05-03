@extends('layouts.admin')

@section('title', tr('sub_admin_edit'))

@section('content-header', tr('store'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    
    <li><a href="{{route('admin.store.index')}}"><i class="fa fa-support"></i> {{tr('store')}}</a></li>
    
    <li class="active"><i class="fa fa-support"></i> {{tr('sub_admin_edit')}}</li>
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
        // alert(dtz);
        $("#userTimezone").val(jstz.determine().name());
    });

</script>

<script src="{{asset('admin-css/plugins/iCheck/icheck.min.js')}}"></script>

@endsection