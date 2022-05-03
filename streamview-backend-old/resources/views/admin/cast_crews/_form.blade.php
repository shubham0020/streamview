<div class="row">

    <div class="col-md-10">

        <div class="box box-warning">

            <div class="box-header table-header-theme">
                <b style="font-size:18px;">@yield('title')</b>
                <a href="{{ route('admin.cast_crews.index') }}" class="btn btn-default pull-right"><i class="fa fa-eye"></i> {{ tr('view_cast_crews') }}</a>
            </div>

            <form class="form-horizontal" action="{{  Setting::get('admin_delete_control') == YES ? '#' : route('admin.cast_crews.save') }}" method="POST" enctype="multipart/form-data" role="form">
                @csrf
                <div class="box-body">

                    @if($cast_crew_details->id)

                        <input type="hidden" name="cast_crew_id" value="{{ $cast_crew_details->id }}">

                    @endif

                    <div class="form-group">
                        <label for="name" class="col-sm-1 control-label">*{{ tr('name') }}</label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" title="{{ tr('only_alphanumeric') }}" id="name" name="name" placeholder="{{ tr('name') }}" value="{{ old('name') ?: $cast_crew_details->name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="picture" class="col-sm-1 control-label">*{{ tr('picture') }}</label>
                        <div class="col-sm-10"> 

                            <input type="file" accept="image/jpeg,image/png" id="picture" name="image" placeholder="{{ tr('picture') }}" onchange="loadFile(this,'image_preview')" @if(!$cast_crew_details->id) required @endif >
                            <p class="help-block">{{ tr('image_validate') }} {{ tr('image_square') }}</p>

                            @if( $cast_crew_details->id != '')

                                <img id="image_preview" style="width: 100px;height: 100px;" src="{{ $cast_crew_details->image }}">
                            @else
                                <img id="image_preview" style="width: 100px;height: 100px;display: none;">
                            @endif

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="description" class="col-sm-1 control-label">*{{ tr('description') }}</label>
                        <br>

                        <div class="col-sm-12">
                            <textarea id="ckeditor" required name="description" class="form-control" placeholder="{{ tr('enter') }} {{ tr('description') }}">{{ old('description') ?: $cast_crew_details->description }}</textarea>
                        </div>
                        
                    </div>

                </div>

                <div class="box-footer">

                    <a href="" class="btn btn-danger">{{ tr('cancel') }}</a>                    
                    <button type="submit" class="btn btn-success pull-right" @if(Setting::get('admin_delete_control') == YES ) disabled @endif >{{ tr('submit') }}</button>
                    
                </div>

            </form>
        
        </div>

    </div>

</div>

