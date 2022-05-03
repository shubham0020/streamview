<div class="col-xs-12 mb-2">

	<form class="col-sm-6 col-sm-offset-6" action="{{route('admin.users.referrals.index')}}" method="GET" role="search">
		@csrf
		<div class="flex right-box">
			<input type="text" value="{{Request::get('search_key')??''}}" class="form-control search_input input-space"  name="search_key" placeholder="{{tr('user_referral_search_placeholder')}}">

			<button type="submit" class="btn btn-default pull-right">
				<span class="glyphicon glyphicon-search"> {{tr('search')}}</span>
			</button>


			<a class="btn btn-default box-left" href="{{route('admin.users.referrals.index')}}">{{tr('clear')}}</a>

		</div>

	</form>

</div>