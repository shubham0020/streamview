@extends('layouts.admin')

@section('title', tr('view_faqs'))

@section('content-header', tr('view_faqs'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.faqs.index')}}"><i class="fa fa-book"></i> {{tr('faqs')}}</a></li>
    <li class="active"> {{tr('view_faqs')}}</li>
@endsection

@section('content')
    
    <div class="row">

        <div class="col-md-12">

            <div class="box ">

                <div class="box-header table-header-theme">

                    <div class="pull-left">
                        <h2 class="box-title" style="color: white"><b>{{$faq_details->question}}</b></h2>
                    </div>

                    <div class="pull-right">
                       
                        @if(Setting::get('admin_delete_control') == YES )

                            <a href="javascript:;" class="btn btn-sm btn-warning" style="text-align: left"><b><i class="fa fa-edit"></i>&nbsp;{{tr('edit')}}</b></a>

                            <a href="javascript:;" class="btn btn-sm btn-danger" style="text-align: left"><b><i class="fa fa-trash"></i>&nbsp;{{tr('delete')}}</b></a>
                                
                        @else

                            <a href="{{route('admin.faqs.edit', ['faq_id' => $faq_details->id] )}}" class="btn btn-sm btn-warning"><b><i class="fa fa-edit"></i>&nbsp;{{tr('edit')}}</b></a>

                            <a onclick="return confirm(&quot;{{tr('faq_delete_confirmation' , $faq_details->question)}}&quot;);"  href="{{ route('admin.faqs.delete',['faq_id' => $faq_details->id] ) }}" class="btn btn-sm btn-danger"><b><i class="fa fa-trash"></i>&nbsp;{{tr('delete')}}</b></a>
                            
                        @endif
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="box-body">

                    <strong><i class="fa fa-book margin-r-5"></i> {{tr('question')}}</strong>
                    <p class="text-muted">{{$faq_details->question}}</p>
                    <hr>

                   
                    <strong><i class="fa fa-book margin-r-5"></i> {{tr('answer')}}</strong>
                    <p class="text-muted"><?= $faq_details->answer?></p>
                    <hr>

                </div>

            </div>
            <!-- /.box -->
        </div>

    </div>
@endsection


