@extends('layouts.admin')

@section('title', tr('view_cast_crews'))

@section('content-header', tr('cast_crews'))

@section('breadcrumb')
    
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>{{ tr('home') }}</a></li>
    <li><a href="{{route('admin.cast_crews.index')}}"><i class="fa fa-users"></i> {{tr('cast_crews')}}</a></li>
    
    <li class="active"><i class="fa fa-users"></i> {{ tr('view_cast_crews') }}</li>

    
@endsection

@section('content')

	<div class="row">

        <div class="col-xs-12">

          	<div class="box box-warning">
	          	
	          	<div class="box-header table-header-theme">
	                
	                <b style="font-size:18px;">{{ tr('view_cast_crews') }}</b>

	                <a href="{{ route('admin.cast_crews.create') }}" class="btn btn-default pull-right"><i class="fa fa-plus"></i> {{ tr('add_cast_crew') }}</a>

	            </div>

	            <div class="box-body">

				@include('admin.cast_crews._search')

				<div class="table table-responsive ">

	              	<table  class="table table-bordered table-striped table-top">

						<thead>
						    <tr>
						      <th>{{ tr('id') }}</th>
							  <th>{{ tr('name') }}</th>
							  <th>{{ tr('total_videos') }}</th>
						      <th>{{ tr('image') }}</th>
						      <th>{{ tr('status') }}</th>
						      <th>{{ tr('action') }}</th>
						    </tr>
						</thead>

						<tbody>

							@foreach($cast_crews as $i => $cast_crew_details)

							    <tr>
							      	<td>{{ showEntries($_GET, $i+1) }}</td>

							      	<td><a href="{{ route('admin.cast_crews.view' , ['cast_crew_id' => $cast_crew_details->id] ) }}"> {{ $cast_crew_details->name }}</a></td>

								     <td>
								     	@if($cast_crew_details->videos_count > 0)
		                                <a href="{{route('admin.videos', ['cast_crew_id' => $cast_crew_details->id])}}">{{$cast_crew_details->videos_count}}</a>
		                                @else
		                                	-
		                                @endif
		                            </td>
							      	<td>
	                                	<img class="image-circle" style="height: 30px;" src="{{ $cast_crew_details->image }}">
									</td>
									
									


                            		<td>
								      	@if($cast_crew_details->status == YES )
								      		<span class="label label-success">{{ tr('approved') }}</span>

								      	@else
								      		<span class="label label-warning">{{ tr('pending') }}</span>
								      	@endif
									</td>
	                            	
							        <td>
	        							<ul class="admin-action btn btn-default">
	        								
	        								<li class="dropdown">
	        								
								                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
								                  {{ tr('action') }} <span class="caret"></span>
								                </a>

								                <ul class="dropdown-menu dropdown-menu-right">

                                             		<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.cast_crews.view' , ['cast_crew_id' => $cast_crew_details->id] ) }}">{{ tr('view') }}</a></li>

													 <li role="presentation" class="divider"></li>
	                                                @if(Setting::get('admin_delete_control') == YES )

                                              		  	<li role="presentation"><a role="button" href="javascript:;" class="btn disabled" style="text-align: left">{{ tr('edit') }}</a></li>

                                              		  	<li role="presentation"><a role="button" href="javascript:;" class="btn disabled" style="text-align: left">{{ tr('delete') }}</a></li>

	                                                @else

                                              		  	<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.cast_crews.edit' , ['cast_crew_id' => $cast_crew_details->id] ) }}">{{ tr('edit') }}</a></li>

                                              		  	<li role="presentation"><a role="menuitem" tabindex="-1" onclick="return confirm(&quot;{{ tr('cast_crew_delete_confirmation' , $cast_crew_details->name) }}&quot;);" href="{{ route('admin.cast_crews.delete' , ['cast_crew_id' => $cast_crew_details->id] ) }}">{{ tr('delete') }}</a></li>

	                                                @endif

	                                                <li role="presentation">

	                                                	<?php $decline_msg = tr('decline_cast_crews');?>
														@if( $cast_crew_details->status == DECLINED )
															<a class="menuitem" tabindex="-1" href="{{ route('admin.cast_crews.status.change',['cast_crew_id' => $cast_crew_details->id] ) }}" onclick="return confirm(&quot;{{ tr('cast_crew_approve_confirmation' , $cast_crew_details->name) }}&quot;);">{{ tr('approve') }} </a>
														@else
															<a class="menuitem" tabindex="-1" href="{{ route('admin.cast_crews.status.change',['cast_crew_id' => $cast_crew_details->id] ) }}"  onclick="return confirm(&quot;{{ tr('cast_crew_decline_confirmation' , $cast_crew_details->name) }}&quot;);" >{{ tr('decline') }}</a>
														@endif

													</li>

								                </ul>

	          								</li>

	        							</ul>

							      	</td>

							    </tr>
							
							@endforeach

						</tbody>

					</table>

</div>

					@if(count($cast_crews) > 0) <div align="right" id="paglink"><?php echo $cast_crews->links(); ?></div> @endif
					
	            </div>
          	</div>
        </div>
    </div>

@endsection