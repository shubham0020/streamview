@extends('layouts.admin')

@section('title', tr('edit_template'))

@section('content-header', tr('edit_template'))

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>{{ tr('home') }}</a></li>
    <li><a href="{{ route('admin.templates.index') }}"><i class="fa fa-book"></i>{{ tr('templates') }}</a></li>
    <li class="active"><i class="fa fa-book"></i> {{ tr('edit_template') }}</li>
@endsection

@section('content')

  	<div class="row">

	    <div class="col-md-10">

	        <div class="box box-warning">

	            <div class="box-header table-header-theme">
                    <b style="font-size:18px;">{{ tr('edit_template') }}</b>
                    <a href="{{ route('admin.templates.index') }}" class="btn btn-default pull-right">{{ tr('templates') }}</a>
                </div>

	            <form  action="{{ Setting::get('admin_delete_control') == YES ? '#' : route('admin.templates.save') }}" method="POST" enctype="multipart/form-data" role="form">
	            	@csrf
	                <div class="box-body">

	                	<input type="hidden" name="template_id" value="{{ $template_details->id }}">

	                     <div class="form-group floating-label">
	                     	<label for="select2">{{ tr('template_type') }}</label>
                            <input type="hidden" required class="form-control" name="template_type" id="template_type" placeholder="{{ tr('enter') }} {{ tr('template_type') }}"  value="{{ old('template_type') ?: $template_details->template_type }}">

                             <input type="text" required class="form-control" id="template_type" readonly value="{{ getTemplateName($template_details->template_type) }}">

                        </div>

	                    <div class="form-group">
	                        <label for="heading">{{ tr('heading') }}</label>
	                        <input type="text" required class="form-control" name="subject" id="heading" placeholder="{{ tr('enter') }} {{ tr('heading') }}" value="{{ old('subject') ?: $template_details->subject }}">
	                    </div>

	                    <div class="form-group">
	                        <label for="description">{{ tr('description') }}</label>

	                        <textarea id="ckeditor" required name="description" class="form-control" placeholder="{{ tr('enter') }} {{ tr('description') }}">{{ old('description') ?: $template_details->description }}</textarea>
	                        
	                    </div>

	                </div>

	              <div class="box-footer">
	                    <button type="reset" class="btn btn-danger">{{ tr('cancel') }}</button>
        
        				<button type="submit" class="btn btn-success pull-right" @if(Setting::get('admin_delete_control') == YES) disabled @endif) >{{ tr('submit') }}</button> 
	              </div>

	            </form>
	        
	        </div>

	    </div>

	</div>
   
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'ckeditor' );
    </script>
@endsection

