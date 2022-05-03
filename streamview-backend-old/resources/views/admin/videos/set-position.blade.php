@extends('layouts.admin')

@section('title', tr('set_position'))

@section('content-header', tr('video_management'))

@section('breadcrumb')

    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>{{ tr('home') }}</a></li>

    <li class="active"><i class="fa fa-video-camera"></i> {{ tr('video_management') }}</li>
    <li class="active"><i class="fa fa-clock-o"></i> {{ tr('set_position') }}</li>
@endsection

@section('content')

<div class="row">

    <div class="col-xs-12">

      	<div class="box box-warning">

          	<div class="box-header table-header-theme">

                <b style="font-size:18px;">@yield('title')</b>

                <a href="{{ route('admin.videos') }}" class="btn btn-default pull-right"><i class="fa fa-eye"></i> {{ tr('view_videos') }}</a>

            </div>

            <div class="box-body">

                <div class="">

                	<h4>Guidelines:</h4>

                	<ul>
                		<li>Based on the filters, the videos will display</li>

                		<li>Set the position for each video and submit</li>

                        <li>Filter - the records will display based on the approved and no of videos greater than 0</li>
                	</ul>

                </div>

            	<hr>

                <div>

                    <form action="{{route('admin.admin_videos_set_position')}}" method="POST" role="filter">
                        @csrf
                    	<div class="form-group col-xs-3">

                            <label for="category_id">{{ tr('choose_category') }}</label>

                            <select class="form-control select2" multiple placeholder="{{tr('choose_category')}}" id="common_category_id" name="category_id[]">

                                @foreach($categories as $category)

                                    <option value="{{$category->id}}">{{$category->name}}</option>

                                @endforeach
                                
                            </select>
                        
                        </div>

                        <div class="form-group col-xs-3">

                            <label for="category_id">{{ tr('choose_sub_category') }}</label>

                            <select class="form-control select2" id="common_sub_category_id" multiple name="sub_category_id[]">

                                @foreach($sub_categories as $sub_category)

                                    <option value="{{$sub_category->id}}">{{$sub_category->name}}</option>

                                @endforeach
                                
                            </select>
                        
                        </div>

                        <div class="form-group col-xs-3">

                            <label for="category_id">{{ tr('choose_genre') }}</label>

                            <select class="form-control select2" id="common_genre_id" multiple name="genre_id[]">

                                @foreach($genres as $genre_details)

                                    <option value="{{$genre_details->id}}">{{$genre_details->name}}</option>

                                @endforeach
                                
                            </select>
                        
                        </div>

                        <div class="col-xs-3">
                            <br>
                            <button type="submit" class="btn btn-primary">{{tr('filter')}}</button>
                            <a class="btn btn-default" href="{{route('admin.admin_videos_set_position')}}">{{tr('clear')}}</a>

                        </div>

                    </form>

                </div>

                <!-- admin videos start -->
                <div class="col-xs-12">

                    <div class="box-header"><h3>{{tr('episodes_list')}}</h3></div>

                    <div class="box-body">

                        @if(count($admin_videos) > 0)

                            <div class=" table-responsive"> 
                            
                                <form action="{{route('admin.admin_videos_change_position_all')}}" method="post" role="search">
                                    {{csrf_field()}}

                                    <table id="example2" class="table table-bordered table-striped">

                                        <thead>
                                            <tr>
                                                <th>{{ tr('id') }}</th>
                                                <th>{{ tr('title') }}</th>
                                                <th>{{ tr('category') }}</th>
                                                <th>{{ tr('sub_category') }}</th>
                                                <th>{{ tr('genre') }}</th>
                                                <th>{{ tr('status') }}</th>
                                                <th>{{ tr('position') }}</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @foreach($admin_videos as $i => $admin_video_details)

                                                <tr>
                                                    <td>{{ showEntries($_GET, $i+1) }}</td>

                                                    <td>
                                                        <a href="{{ route('admin.view.video' , ['id' => $admin_video_details->id] ) }}">{{ substr($admin_video_details->title , 0,25) }}...</a>
                                                    </td>

                                                    <td>{{ $admin_video_details->category->name ?? "-" }}</td>
                                                  
                                                    <td>{{ $admin_video_details->subCategory->name ?? "-" }}</td>
                                                  
                                                    <td>{{ $admin_video_details->genreName->name ?? '-' }}</td>

                                                    <td>
                                                        @if ($admin_video_details->compress_status < OVERALL_COMPRESS_COMPLETED)
                                                            <span class="label label-danger">{{ tr('compress') }}</span>
                                                        @else
                                                            @if($admin_video_details->is_approved)
                                                                <span class="label label-success">{{ tr('approved') }}</span>
                                                            @else
                                                                <span class="label label-warning">{{ tr('pending') }}</span>
                                                            @endif
                                                        @endif
                                                    </td>

                                                    <td>

                                                        <div class="form-group">

                                                            <input type="number" name="position[{{$admin_video_details->id}}]" class="form-control" value="{{$admin_video_details->position}}" id="position_{{$admin_video_details->id}}">

                                                            <button class="btn btn-warning" onclick='return videoSetPosition("{{$admin_video_details->id}}")''>{{tr('update')}}</button>

                                                        </div>

                                                    </td>

                                                </tr>

                                            @endforeach

                                        </tbody>   
                                        <tfoot>
                                            <tr>
                                                <th colspan="6" style="text-align:right">Fill the positions and update with one click here</th>
                                                <th><button class="btn btn-success" type="submit">{{tr('update_all_positions')}}</button></th>
                                            </tr>
                                        </tfoot>                             
                                    </table>

                                    <div align="right" id="paglink">{{$admin_videos->links()}}</div>

                                </form>

                            </div>

                        @else 
                
                            <h3 class="no-result">{{ tr('no_video_found') }}</h3>

                        @endif
                    
                    </div>

                </div>
                <!-- admin videos end -->

            </div>

      	</div>
    
    </div>
</div>

@endsection

@section('scripts')

<script>

    var cat_url = "{{ url('select/sub_category')}}";
    
    var sub_cat_url = "{{ url('select/genre')}}";

    function videoSetPosition(admin_video_id) {

        var position = $('#position_'+admin_video_id).val();

        if(position <= 0) {
            alert("The position is invalid");
        }

        $.ajax({
            type : 'post',
            url : "{{route('admin.save.video.position')}}",
            data : {'admin_video_id': admin_video_id, 'position': position},
            beforeSend : function(data) {
                $("#position_btn_"+admin_video_id).attr('disabled', true);
            },
            success : function(response) {

                console.log(response);

                if(response.success) {

                    alert(response.message);

                } else {

                    alert(response.error);

                    $("#error_messages_text").html(response.error);

                }
            },
            error : function(data) {
                $("#position_btn_"+admin_video_id).attr('disabled', false);
            },
            complete : function(data) {
                $("#position_btn_"+admin_video_id).attr('disabled', false);
            }

        });

        return false;
    
    }

    $('#common_category_id').on('change', function() {

        var category_id = $('#common_category_id').val();

        $.ajax ({
            type : 'post',
            url : cat_url,
            data : {option: category_id},
            success : function(data) {
                // console.log(data);return false;
                if (data == undefined) {
                    alert("Oops Something went wrong. Kindly contact your administrator.");
                    return false;
                }
                if (data.length == 0) {
                    alert('No sub categories available. Kindly contact support team.');
                    return false;
                }
                var subcategory = '';

                $('#common_sub_category_id').empty().trigger("change");

                for(var i=0; i < data.length; i++) {

                    var value = data[i];

                    var option = new Option(value.name, value.id);
                    
                    $("#common_sub_category_id").append(option);

                }
            },
            error : function(data) {
                alert("Oops Something went wrong. Kindly contact your administrator.");
            }
        
        });

    });

    $('#common_sub_category_id').on('change', function() {

        var sub_category_id = $('#common_sub_category_id').val();

        if(!sub_category_id) {

            return false;

        }

        $.ajax ({
            type : 'post',
            url : sub_cat_url,
            data : {option: sub_category_id},
            success : function(data) {
                // console.log(data);return false;
                if (data == undefined) {
                    alert("Oops Something went wrong. Kindly contact your administrator.");
                    return false;
                }
                if (data.length == 0) {
                    alert('No genres available. Kindly contact support team.');
                    return false;
                }
                var subcategory = '';

                $('#common_genre_id').empty().trigger("change");

                for(var i=0; i < data.length; i++) {

                    var value = data[i];

                    var option = new Option(value.name, value.id);
                    
                    $("#common_genre_id").append(option);

                }
            },
            error : function(data) {
                alert("Oops Something went wrong. Kindly contact your administrator.");
            }
        
        });
    });
</script>

@endsection