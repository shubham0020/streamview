@extends('layouts.admin')

@section('title', tr('add_subscription'))

@section('content-header', tr('subscriptions'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.subscriptions.index')}}"><i class="fa fa-key"></i> {{tr('subscriptions')}}</a></li>
    <li class="active">{{tr('add_subscription')}}</li>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-10 ">

            <div class="box box-warning">

                <div class="box-header table-header-theme">
                    <h2 class="box-title"> <b>{{tr('add_subscription')}}</b></h2>
                    <a href="{{route('admin.subscriptions.index')}}" style="float:right" class="btn btn-default"><i class="fa fa-eye"></i> {{tr('view_subscriptions')}}</a>
                </div>

                @include('admin.subscriptions._form')
              
            </div>

        </div>

    </div>

@endsection