
<div class="row">

    <div class="col-md-10">
        
        <div class="box box-warning">

            <div class="box-header table-header-theme">
                <b style="font-size:18px;">@yield('title')</b>
                <a href="{{ route('admin.store.index') }}" class="btn btn-default pull-right"><i class="fa fa-eye"></i> {{ tr('store_view') }}</a>
            </div>

            <form class="form-horizontal" action="{{ route('admin.store.save') }}" method="POST" enctype="multipart/form-data" role="form">
                @csrf
                <div class="box-body">

                    <input type="hidden" name="timezone" value="{{ $store_details->timezone }}" id="userTimezone">
                    @if($store_details->id)
                    <input type="hidden" name="store_id" value="{{$store_details->id}}">
                    @endif

                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">* {{ tr('username') }}</label>

                        <div class="col-sm-10">
                            <input type="text" required name="name" title="{{ tr('only_alphanumeric') }}" class="form-control" id="username" placeholder="{{ tr('name') }}" value="{{ old('name') ?: $store_details->name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">* {{ tr('email') }}</label>
                        <div class="col-sm-10">
                            <input type="email" maxlength="255" required class="form-control" id="email" name="email"placeholder="{{ tr('email') }}" value="{{ old('email') ?: $store_details->email  }}">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="mobile" class="col-sm-2 control-label">* {{ tr('mobile') }}</label>

                        <div class="col-sm-10">
                            <input type="tel" pattern="[1-9]{1}[0-9]{2,16}" required name="mobile" class="form-control" id="mobile" placeholder="{{ tr('mobile') }}" minlength="4" maxlength="16"  value="{{ old('mobile') ?: $store_details->mobile }}">
                            <br>
                             <small style="color:brown">{{ tr('mobile_note') }}</small>
                        </div>
                    </div>

                    @if(!$store_details->id)

                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">* {{ tr('password') }}</label>

                        <div class="col-sm-10">
                            <input type="password" required  name="password"  title="{{ tr('password_notes') }}" class="form-control" id="password" placeholder="{{ tr('password') }}" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="col-sm-2  control-label">* {{ tr('password_confirmation') }}</label>

                        <div class="col-sm-10">
                            <input type="password" required title="{{ tr('password_notes') }}"  name="password_confirmation" class="form-control" id="password_confirmation" placeholder="{{ tr('password_confirmation') }}" value="">
                        </div>
                    </div>

                    @endif

                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">{{ tr('description') }}</label>
                        <div class="col-sm-10">
                           <textarea class="form-control" name="description" placeholder="{{ tr('description') }}">{{ old('description') ?: $store_details->description}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="picture" class="col-sm-2 control-label">{{ tr('picture')  }}</label>

                        <div class="col-sm-10">
                            <input type="file" name="picture" value="{{ old('picture') ?: $store_details->picture  }}" class="form-control" id="picture" placeholder="{{ tr('picture') }}">
                            <p class="help-block">{{tr('note')}} : {{tr('image_validate')}}</p>
                        </div>
                    </div>

                </div>

                <div class="box-footer">
                    
                    <button type="reset" class="btn btn-danger">{{ tr('cancel') }}</button>
                    
                    <button type="submit" class="btn btn-success pull-right"  @if(Setting::get('admin_delete_control') == YES) disabled @endif>{{ tr('submit') }}</button>                    
                </div>
                
            </form>
        
        </div>

    </div>

</div>
