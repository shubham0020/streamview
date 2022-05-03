@extends('layouts.admin')

@section('title', tr('faqs'))

@section('content-header', tr('faqs'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.faqs.index')}}"><i class="fa fa-book"></i> {{tr('faqs')}}</a></li>
    <li class="active"><i class="fa fa-book"></i> {{tr('view_faqs')}}</li>
    
@endsection

@section('content')

    <div class="row">
    
        <div class="col-xs-12">

            <div class="box box-warning">

                <div class="box-header table-header-theme">

                    <h2 class="box-title" ><b>{{tr('view_faqs')}}</b></h2>
                    <a href="{{route('admin.faqs.create')}}" style="float:right" class="btn btn-default"><i class="fa fa-plus"></i> {{tr('add_faq')}}</a>
              

                </div>

                <div class="box-header">
                     @include('admin.faqs._search')

                </div>

                <div class="box-body table-responsive">

                    <table id="example2" class="table table-bordered table-striped ">

                        <thead>
                            <tr>
                              <th>{{tr('id')}}</th>
                              <th>{{tr('question')}}</th>
                              <th>{{tr('status')}}</th>
                              <th>{{tr('action')}}</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($faqs as $i => $faq_details)
                    
                                <tr>
                                    <td>{{showEntries($_GET, $i+1)}}</td>
                                    <td><a href="{{route('admin.faqs.view', ['faq_id' => $faq_details->id] )}}">{{$faq_details->question}}</a></td>
                                   
                                    <td>
                                     @if($faq_details->status == YES)
                                     {{tr('approved')}}
                                     @else
                                     {{tr('pending')}}
                                     @endif
                                    
                                    </td>
                                    
                                    <td>

                                        <div class="dropdown">
                                            
                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{tr('action')}}
                                                <span class="caret"></span>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu">

                                                <li>    
                                                    <a href="{{route('admin.faqs.view', ['faq_id' => $faq_details->id] )}}"><b>{{tr('view')}}</b></a>
                                                </li>

                                                @if(Setting::get('admin_delete_control') == YES )

                                                    <li><a href="javascript:;" class="btn disabled" style="text-align: left"><b>{{tr('edit')}}</b></a></li>

                                                    <li><a href="javascript:;" class="btn disabled" style="text-align: left"><b>{{tr('delete')}}</b></a></li>

                                                @else

                                                    <li><a href="{{route('admin.faqs.edit', ['faq_id' => $faq_details->id] )}}"><b>{{tr('edit')}}</b></a></li>

                                                    <li><a onclick="return confirm(&quot;{{tr('faq_delete_confirmation' , $faq_details->question)}}&quot;);" href="{{ route('admin.faqs.delete',['faq_id' => $faq_details->id] ) }}"><b>{{tr('delete')}}</b></a></li>
                                                @endif

                                            </ul>

                                        </div>
                                        
                                    </td>
                                
                                </tr>

                            @endforeach

                        </tbody>
                    
                    </table>

                    @if(count($faqs) > 0) <div align="right" id="paglink"><?php echo $faqs->links(); ?></div> @endif

                </div>

            </div>

        </div>

    </div>

@endsection