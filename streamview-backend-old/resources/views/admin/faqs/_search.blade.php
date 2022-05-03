<div class="col-md-12">

	<form action="{{route('admin.faqs.index')}}" method="GET" role="search">
		@csrf
		<div class="flex right-box">

			<div>
				<input type="text" value="{{Request::get('search_key')??''}}" class="form-control search_input input-space" name="search_key" placeholder="{{tr('faq_search_placeholder')}}">
			</div>
			
			<button type="submit" class="btn btn-default">
				<span class="glyphicon glyphicon-search"> {{tr('search')}}</span>
			</button>


			<a class="btn btn-default  box-left" href="{{route('admin.faqs.index')}}">{{tr('clear')}}</a>

		</div>

	</form>

</div>