<div class="col-md-12">

	<form action="{{route('admin.users.index')}}" method="GET" role="search">
		@csrf
		<div class="flex right-box">

			<div>
				<input type="text" value="{{Request::get('search_key')??''}}" class="form-control search_input input-space" name="search_key" placeholder="{{tr('user_search_placeholder')}}">
			</div>
			
			@if(!Request::get('sort'))
			<select class="form-control select-width input-space" name="status">
				<option value="">{{tr('select_status')}}</option>
				<option value="{{APPROVED}}" @if(Request::get('status')==APPROVED) selected @endif>{{tr('approved')}}</option>
				<option value="{{DECLINED}}" @if(Request::get('status')==DECLINED && Request::get('status')!='' ) selected @endif>{{tr('pending')}}</option>
			</select>
			@endif

			<button type="submit" class="btn btn-default">
				<span class="glyphicon glyphicon-search"> {{tr('search')}}</span>
			</button>


			@if(Request::get('sort'))
			<input type="hidden" name="sort" value="declined">
			<a class="btn btn-default box-left" href="{{route('admin.users.index',['sort'=>'declined'])}}">{{tr('clear')}}</a>
			@else
			<a class="btn btn-default  box-left" href="{{route('admin.users.index')}}">{{tr('clear')}}</a>

			@endif
		</div>

	</form>

</div>