<div class="col-xs-12 mb-2  bottom-space">

    <form class="col-sm-8 col-sm-offset-4" action="{{route('admin.cast_crews.index')}}" method="GET" role="search">
        @csrf
        <div class="flex">
            <input type="text" class="form-control search_input input-space" name="search_key" placeholder="{{tr('cast_crews_search_placeholder')}}">

            <select class="form-control select-width input-space" name="status">
                <option value="">{{tr('select_status')}}</option>
                <option value="{{APPROVED}}" @if(Request::get('status')==APPROVED) selected @endif>{{tr('approved')}}</option>
                <option value="{{DECLINED}}" @if(Request::get('status')==DECLINED && Request::get('status')!='' ) selected @endif>{{tr('pending')}}</option>
            </select> 

            <button type="submit" class="btn btn-default pull-right">
                <span class="glyphicon glyphicon-search"> {{tr('search')}}</span>
            </button>
            <a class="btn btn-default box-left" href="{{route('admin.cast_crews.index')}}">{{tr('clear')}}</a>

        </div>

    </form>

</div>