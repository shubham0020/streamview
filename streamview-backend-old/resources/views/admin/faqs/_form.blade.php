<form  action="{{ Setting::get('admin_delete_control') == YES ? '#' : route('admin.faqs.save') }}" method="POST" enctype="multipart/form-data" role="form">
    @csrf
    <div class="box-body">

        @if($faq_details->id)
            <input type="hidden" name="faq_id" value="{{$faq_details->id}}">
        @endif
        

        <div class="form-group">
            <label for="question">*{{ tr('question') }}</label>
            <input type="text" class="form-control" name="question" required value="{{old('question')?:$faq_details->question }}" id="question" placeholder="{{ tr('enter_question') }}">
        </div>

        <div class="form-group">
            <label for="answer">*{{ tr('answer') }}</label>

            <textarea id="ckeditor" name="answer" class="form-control" required placeholder="{{ tr('enter_text') }}">{{ old('answer') ?: $faq_details->answer }}</textarea>
            
        </div>

    </div>

    <div class="box-footer">
            <button type="reset" class="btn btn-danger">{{ tr('cancel') }}</button>
            
            <button type="submit" class="btn btn-success pull-right" @if(Setting::get('admin_delete_control') == YES) disabled @endif) >{{ tr('submit') }}</button> 
    </div>

</form>