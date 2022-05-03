@extends('layouts.admin')

@section('title', tr('view_wishlist'))

@section('content-header')

{{tr('view_wishlist')}} 

 	@if($user_sub_profile_details)
 		- <a  href="{{ route('admin.users.subprofiles' , ['user_id' => $user_sub_profile_details->id] ) }}"> {{ $user_sub_profile_details->name }} </a>
 	@endif

@endsection

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>{{ tr('home') }}</a></li>
    <li><a href="{{ route('admin.users.index') }}"><i class="fa fa-user"></i> {{ tr('users') }}</a></li>
    <li><a href="{{ route('admin.users.subprofiles', ['user_id' => $user_sub_profile_details->user_id] ) }}"> <i class="fa fa-user"></i> {{ tr('sub_profiles') }}</a></li>
    <li class="active"> {{ tr('view_wishlist') }}</li>
@endsection

@section('content')

	<div class="row">

        <div class="col-xs-12">
			
          	<div class="box">

	            <div class="box-body">

	            	@if(count($user_wishlists) > 0)

		              	<table id="datatable-withoutpagination" class="table table-bordered table-striped">

							<thead>
							    <tr>
							      <th>{{ tr('id') }}</th>
							      <th>{{ tr('video') }}</th>
							      <th>{{ tr('date') }}</th>
							      <th>{{ tr('action') }}</th>
							    </tr>
							</thead>

							<tbody>

								@foreach($user_wishlists as $i => $wishlist_details)

								    <tr>
								      	<td>{{ showEntries($_GET, $i+1) }}</td>

								      	<td>{{ $wishlist_details->title }}</td>

								      	<td>{{ $wishlist_details->date }}</td>

									    <td>
	            							
	            							<ul class="admin-action btn btn-default">
	            								
	            								<li class="dropup">

									                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
									                  {{ tr('action') }} 
									                  <span class="caret"></span>
									                </a>

									                <ul class="dropdown-menu dropdown-menu-right">
									                  	<li role="presentation"><a role="menuitem" tabindex="-1" onclick="return confirm(&quot;{{ tr('user_wishlist_delete_confirmation' , $wishlist_details->title) }}&quot;);" href="{{ route('admin.users.wishlist.remove' , ['user_wishlist_id' => $wishlist_details->wishlist_id] ) }}">{{ tr('delete_wishlist') }}</a></li>
									                </ul>

	              								</li>

	            							</ul>

									    </td>

								    </tr>					

								@endforeach

							</tbody>
						
						</table>

						<div align="right" id="paglink"><?php echo $user_wishlists->links(); ?></div>
						
					@else
						<h3 class="no-result">{{ tr('no_wishlist_found') }}</h3>
					@endif

	            </div>

          	</div>

        </div>

    </div>

@endsection


