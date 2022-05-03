<div class="col-xs-12 ml-5">

	<form class="col-sm-7 col-sm-offset-5 ml-5" action="{{route('admin.sub_categories.index',['category_id' => $category_details->id])}}" method="GET" role="search">
		@csrf
		<div class="flex">
			<input type="text" class="form-control search_input  input-space" name="search_key" placeholder="{{tr('subcategory_search_placeholder')}}">

			<select class="form-control select-width input-space" name="status">
				<option value="">{{tr('select_status')}}</option>
				<option value="{{APPROVED}}" @if(Request::get('status')==APPROVED) selected @endif>{{tr('approved')}}</option>
				<option value="{{DECLINED}}" @if(Request::get('status')==DECLINED && Request::get('status')!='' ) selected @endif>{{tr('pending')}}</option>
			</select>


			<button type="submit" class="btn btn-default pull-right">
				<span class="glyphicon glyphicon-search"> {{tr('search')}}</span>
			</button>
			<a class="btn btn-default box-left" href="{{route('admin.sub_categories.index',['category_id' => $category_details->id])}}">{{tr('clear')}}</a>

		</div>

	</form>

</div>