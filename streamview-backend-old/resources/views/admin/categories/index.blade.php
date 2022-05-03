@extends('layouts.admin')

@section('title', tr('view_categories'))

@section('content-header', tr('categories'))

@section('breadcrumb')
<li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>{{ tr('home') }}</a></li>
<li><a href="{{route('admin.categories.index')}}"><i class="fa fa-suitcase"></i> {{tr('categories')}}</a></li>
<li class="active"><i class="fa fa-suitcase"></i> {{ tr('view_categories') }}</li>

@endsection

@section('content')

<div class="row">

	<div class="col-xs-12">

		<div class="box box-warning">

			<div class="box-header table-header-theme">
				<b style="font-size:18px;">{{ tr('view_categories') }}</b>
				<a href="{{ route('admin.categories.create') }}" class="btn btn-default pull-right"><i class="fa fa-plus"></i> {{ tr('add_category') }}</a>
			</div>

			<div class="box-body">

				<div class="table-responsive">

				    @include('admin.categories._search')

					@if(count($categories) > 0)
					<div class="table table-responsive ">

						<table class="table table-bordered table-striped table-top">

							<thead>
								<tr>
									<th>{{ tr('id') }}</th>
									<th>{{ tr('category') }}</th>
									<th>{{ tr('picture') }}</th>
									<th>{{ tr('total_videos') }}</th>
									<th>{{ tr('sub_categories') }}</th>
									<th>{{ tr('is_series') }}</th>
									<th>{{ tr('status') }}</th>
									<th>{{ tr('action') }}</th>
								</tr>
							</thead>

							<tbody>

								@foreach($categories as $i => $category_details)

								<tr>
									<td>{{ showEntries($_GET, $i+1) }}</td>

									<td><a href="{{ route('admin.categories.view' , ['category_id' => $category_details->id] ) }}">
											{{ $category_details->name }}</a>
									</td>

									<td>
										<img style="height: 30px;" src="{{ $category_details->picture }}">
									</td>

									<td>
										@if($category_details->videos_count > 0)
										<a href="{{route('admin.videos', ['category_id' => $category_details->id])}}">{{$category_details->videos_count}}</a>
										@else
										 0 
										@endif
									</td>

									<td>
										<a href="{{ route('admin.sub_categories.index' , ['category_id' => $category_details->id] ) }}">
											{{ $category_details->subCategory ? count($category_details->subCategory) : '0' }}</a>
									</td>

									<td>
										@if($category_details->is_series ==YES )
										<span class="label label-success">{{ tr('yes') }}</span>
										@else
										<span class="label label-warning">{{ tr('no') }}</span>
										@endif
									</td>

									<td>
										@if($category_details->is_approved == CATEGORY_APPROVED)
										<span class="label label-success">{{ tr('approved') }}</span>
										@else
										<span class="label label-warning">{{ tr('pending') }}</span>
										@endif
									</td>

									<td>
										<ul class="admin-action btn btn-default">

											<li class="{{ $i <= 1 ? 'dropdown' : 'dropup' }}">

												<a class="dropdown-toggle" data-toggle="dropdown" href="#">
													{{ tr('action') }} <span class="caret"></span>
												</a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li>
														<a href="{{ route('admin.categories.view' , ['category_id' => $category_details->id] ) }}">{{ tr('view') }}</a>
													</li>

													@if(Setting::get('admin_delete_control') == YES )

													<li role="presentation">
														<a role="button" href="javascript:;" class="btn disabled" style="text-align: left">{{ tr('edit') }}</a>
													</li>
													<li role="presentation">
														<a role="button" href="javascript:;" class="btn disabled" style="text-align: left">{{ tr('delete') }}</a>
													</li>

													@else
													<li role="presentation">
														<a role="menuitem" tabindex="-1" href="{{ route('admin.categories.edit' , ['category_id' => $category_details->id] ) }}">{{ tr('edit') }}</a>
													</li>
													<li role="presentation">
														<a role="menuitem" tabindex="-1" onclick="return confirm(&quot;{{ tr('category_delete_confirmation' , $category_details->name) }}&quot;);" href="{{ route('admin.categories.delete' , ['category_id' => $category_details->id] ) }}">{{ tr('delete') }}</a>
													</li>

													@endif
													<li class="divider" role="presentation"></li>

													@if($category_details->is_approved == CATEGORY_APPROVED )
													<li role="presentation"><a role="menuitem" tabindex="-1" onclick="return confirm(&quot;{{ tr('category_decline_confirmation' , $category_details->name) }}&quot;);" href="{{ route('admin.categories.status.change', ['category_id' => $category_details->id] ) }}">{{ tr('decline') }}</a></li>
													@else
													<li role="presentation"><a role="menuitem" tabindex="-1" onclick="return confirm(&quot;{{ tr('category_approve_confirmation' , $category_details->name) }}&quot;);" href="{{ route('admin.categories.status.change', ['category_id' => $category_details->id]) }}">{{ tr('approve') }}</a></li>
													@endif

													<li class="divider" role="presentation"></li>

													<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.sub_categories.create', ['category_id' => $category_details->id] ) }}">{{ tr('add_sub_category') }}</a></li>

													<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.sub_categories.index', ['category_id' => $category_details->id] ) }}">{{ tr('view_sub_categories') }}</a></li>

													<li class="divider" role="presentation"></li>

													<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.videos', ['category_id' => $category_details->id] ) }}">{{ tr('videos') }}</a></li>
												</ul>

											</li>

										</ul>

									</td>

								</tr>

								@endforeach

							</tbody>

						</table>
					</div>
					<div align="right" id="paglink"><?php echo $categories->links(); ?></div>
					@else
					<h3 class="no-result">{{ tr('no_result_found') }}</h3>
					@endif

				</div>

			</div>
		</div>
	</div>

	@endsection