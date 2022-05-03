@extends('layouts.admin.focused')

@section('title', tr('reset_password'))

@section('content')

<div class="login-box-body" style="height:400px">

    <form class="form-layout" role="form" method="POST" action="{{route('admin.reset_password.update')}}">
        @csrf
        

        @if(Request::get('token'))
        <input type="hidden" id="reset_token" name="reset_token" value="{{Request::get('token') ?? ''}}">
        @endif
        
        <div class="login-logo">
            <a href="{{route('admin.login')}}"><b>{{Setting::get('site_name')}}</b></a>
        </div>

        <p class="text-center mb25">{{tr('password_reset_msg')}}</p>

        <div class="form-inputs">


            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control input-lg" name="password" placeholder="{{tr('password')}}" required>

                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <input type="password" class="form-control input-lg" name="password_confirmation" placeholder="{{tr('confirm_password')}}" required>

                @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="col-md-6 col-md-offset-3">
            <button class="btn btn-success btn-block mb15" type="submit">
                <span><i class="fa fa-btn fa-refresh"></i>{{tr('reset')}}</span>
            </button>
        </div>

    </form>

</div>

@endsection