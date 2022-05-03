
@extends('layouts.subAdmin.focused')

@section('title', tr('reset_password'))

@section('content')

    <!-- /.login-logo -->

    <div class="login-box-body" style="height:300px">

        <form class="form-layout" role="form" method="POST" action="{{ url('/subAdmin/password/email') }}">
            {{ csrf_field() }}

            <div class="text-center mb15">
                <img src="{{ Setting::get('site_logo', asset('logo.png')) }}" />
            </div>

            <p class="text-center mb25">{{tr('enter_email_address')}}</p></br>

            <div class="form-inputs">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{tr('email_add')}}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <button class="pull-right btn btn-warning btn-block mb15" type="submit">
                            <i class="fa fa-btn fa-envelope"></i>{{tr('reset')}}
                        </button>

                         <a href="{{route('subAdmin.dashboard')}}" class="pull-left btn btn-info btn-block mb15">
                            <i class="fa fa-btn fa-user"></i> {{tr('login')}}
                        </a>
                    </div>
                </div>

            </div>
        </form>

    </div>

@endsection
