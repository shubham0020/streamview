@extends('layouts.moderator')

@section('title', tr('profile'))

@section('content-header', tr('profile'))

@section('breadcrumb')
<li class="active"><i class="fa fa-diamond"></i> {{tr('profile')}}</li>
@endsection

@section('content')

@include('notification.notify')


<div class="row">

    <div class="col-md-4">

        <div class="box box-primary">

            <div class="box-body box-profile">

                <img class="profile-user-img img-responsive img-circle" src="{{$moderator_details->picture ?: asset('admin-css/dist/img/avatar.png')}}" alt="{{$moderator_details->name}}">

                <h3 class="profile-username text-center">{{$moderator_details->name}}</h3>

                <p class="text-muted text-center">{{tr('moderator')}}</p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>{{tr('name')}}</b> <a class="pull-right">{{$moderator_details->name}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>{{tr('email')}}</b> <a class="pull-right">{{$moderator_details->email}}</a>
                    </li>

                    <li class="list-group-item">
                        <b>{{tr('mobile')}}</b> <a class="pull-right">{{$moderator_details->mobile}}</a>
                    </li>

                    <li class="list-group-item">
                        <b>{{tr('paypal_email')}}</b> <a class="pull-right">{{$moderator_details->paypal_email}}</a>
                    </li>

                    <li class="list-group-item">
                        <b>{{tr('address')}} : </b>{{$moderator_details->address}}
                    </li>


                </ul>

            </div>

        </div>

    </div>

    <div class="col-md-8">
        <div class="nav-tabs-custom">

            <ul class="nav nav-tabs">
                <li class="active"><a href="#profile_name" data-toggle="tab">{{tr('update_profile')}}</a></li>
                <li><a href="#image" data-toggle="tab">{{tr('upload_image')}}</a></li>
                <li><a href="#password" data-toggle="tab">{{tr('change_password')}}</a></li>
            </ul>

            <div class="tab-content">

                <div class="active tab-pane" id="profile_name">

                    <form class="form-horizontal" action="{{(Setting::get('admin_delete_control') == 1) ? '' : route('moderator.save.profile')}}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="id" value="{{$moderator_details->id}}">

                        <div class="form-group">
                            <label for="name" required class="col-sm-2 control-label">{{tr('name')}}</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name') ?: $moderator_details->name}}" placeholder="{{tr('name')}}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">{{tr('email')}}</label>

                            <div class="col-sm-10">
                                <input type="email" required value="{{old('email') ?: $moderator_details->email}}" name="email" class="form-control" id="email" placeholder="{{tr('email')}}" readonly>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="mobile" class="col-sm-2 control-label">{{tr('mobile')}}</label>

                            <div class="col-sm-10">
                                <input type="text" required value="{{old('mobile') ?: $moderator_details->mobile}}" name="mobile" class="form-control" id="mobile" placeholder="{{tr('mobile')}}" pattern="[0-9]{4,16}">
                                <small style="color:brown">{{tr('mobile_note')}}</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-sm-2 control-label">{{tr('address')}}</label>

                            <div class="col-sm-10">
                                <input type="text" value="{{old('address') ?: $moderator_details->address}}" name="address" class="form-control" id="address" placeholder="{{tr('address')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-sm-2 control-label">{{tr('paypal_email')}}</label>

                            <div class="col-sm-10">
                                <input type="text" value="{{old('paypal_email') ?: $moderator_details->paypal_email}}" name="paypal_email" class="form-control" id="paypal_email" placeholder="{{tr('paypal_email')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                @if(Setting::get('admin_delete_control') == 1)
                                <button type="submit" class="btn btn-danger" disabled>{{tr('submit')}}</button>
                                @else
                                <button type="submit" class="btn btn-danger">{{tr('submit')}}</button>
                                @endif
                            </div>
                        </div>

                    </form>
                </div>

                <div class="tab-pane" id="image">

                    <form class="form-horizontal" action="{{(Setting::get('admin_delete_control') == 1) ? '' : route('moderator.save.profile')}}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="id" value="{{$moderator_details->id}}">
                        <input type="hidden" name="name" value="{{$moderator_details->name}}">

                        @if($moderator_details->picture)
                        <img style="height: 90px; margin-bottom: 15px; border-radius:2em;" src="{{$moderator_details->picture}}">
                        @else
                        <img style="height: 90px; margin-bottom: 15px; border-radius:2em;" src="{{asset('admin-css/dist/img/avatar.png')}}">
                        @endif

                        <div class="form-group">
                            <label for="picture" class="col-sm-2 control-label">{{tr('picture')}}</label>

                            <div class="col-sm-10">
                                <input type="file" required accept="image/png, image/jpeg" name="picture" id="picture">
                                <p class="help-block">{{tr('image_validate')}} {{tr('image_square')}}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                @if (Setting::get('admin_delete_control') == 1)
                                <button type="submit" class="btn btn-danger" disabled>{{tr('submit')}}</button>
                                @else
                                <button type="submit" class="btn btn-danger">{{tr('submit')}}</button>
                                @endif
                            </div>
                        </div>

                    </form>
                </div>

                <div class="tab-pane" id="password">

                    <form class="form-horizontal" action="{{(Setting::get('admin_delete_control') == 1) ? '' : route('moderator.change.password')}}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="id" value="{{$moderator_details->id}}">

                        <div class="form-group">
                            <label for="old_password" class="col-sm-3 control-label">{{tr('old_password')}}</label>

                            <div class="col-sm-8">
                                <input required type="password" class="form-control" name="old_password" id="old_password" placeholder="{{tr('old_password')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">{{tr('new_password')}}</label>

                            <div class="col-sm-8">
                                <input required type="password" class="form-control" name="password" id="new_password" placeholder="{{tr('new_password')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password" class="col-sm-3 control-label">{{tr('confirm_password')}}</label>

                            <div class="col-sm-8">
                                <input required type="password" class="form-control" name="password_confirmation" id="confirm_password" placeholder="{{tr('confirm_password')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                @if(Setting::get('admin_delete_control') == 1)
                                <button type="submit" class="btn btn-danger" disabled id="change_password_submit">{{tr('submit')}}</button>
                                @else
                                <button type="submit" class="btn btn-danger" id="change_password_submit">{{tr('submit')}}</button>
                                @endif
                            </div>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>


@endsection


@section('scripts')
<script type="text/javascript">
    $('body').on('click', '#change_password_submit', function() {

        if ($('#old_password').val() != '' && $('#new_password').val() != '' && $('#confirm_password').val() != '') {

            var result = confirm("{{tr('password_change_confirmation')}}");

            if (!result)
                return false;
        }


    });
</script>
@endsection
