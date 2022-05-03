@extends('layouts.admin')

@section('title', tr('edit_moderator'))

@section('content-header', tr('moderators'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.moderators.index')}}"><i class="fa fa-users"></i> {{tr('moderators')}}</a></li>
    <li class="active">{{tr('edit_moderator')}}</li>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-10">

            <div class="box box-warning">

                <div class="box-header table-header-theme">
                    <b style="font-size:18px;">{{tr('edit_moderator')}}</b>
                    <a href="{{route('admin.moderators.create')}}" class="btn btn-default pull-right"><i class="fa fa-plus"></i> {{tr('add_moderator')}}</a>
                </div>

                @include('admin.moderators._form')

            </div>

        </div>

    </div>

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