<div class="col-xs-12 mb-2 bottom-space">

    <form class="col-sm-8 col-sm-offset-4" action="{{route('admin.sub_admins.index')}}" method="GET" role="search">
        @csrf
        <div class="flex right-box">
            <div>
            <input type="text" value="{{Request::get('search_key')??''}}" class="form-control search_input input-space" name="search_key" placeholder="{{tr('subadmin_search_placeholder')}}">
           </div>

            @if(Request::get('sort')=='')
            <select class="form-control select-width input-space" name="status">
                <option value="">{{tr('select_status')}}</option>
                <option value="{{APPROVED}}" @if(Request::get('status')==APPROVED) selected @endif>{{tr('approved')}}</option>
                <option value="{{DECLINED}}" @if(Request::get('status')==DECLINED && Request::get('status')!='' ) selected @endif>{{tr('declined')}}</option>
            </select> 
            @endif

            <button type="submit" class="btn btn-default pull-right">
                <span class="glyphicon glyphicon-search"> {{tr('search')}}</span>
            </button>

            @if(Request::get('sort')!='')
            <input type="hidden" name="sort" value="{{Request::get('sort')??''}}">
            <a class="btn btn-default box-left" href="{{route('admin.sub_admins.index',['sort'=>DECLINED])}}">{{tr('clear')}}</a>
            @else
            <a class="btn btn-default box-left" href="{{route('admin.sub_admins.index')}}">{{tr('clear')}}</a>

            @endif

        </div>

    </form>

</div>