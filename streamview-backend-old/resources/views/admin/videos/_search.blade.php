<div class="col-xs-12 mb-2 admin_videos  bottom-space">

    <form class="col-sm-9 col-sm-offset-3 right-box" action="{{route('admin.videos')}}" method="GET" role="search">
        @csrf
        <div class="flex">
            <input type="text" value="{{Request::get('search_key')??''}}" class="form-control search_input input-space" name="search_key" placeholder="{{tr('video_search_placeholder')}}">


            <select class="form-control select-width input-space" name="status">
                <option value="">{{tr('select_status')}}</option>
                <option value="{{APPROVED}}" @if(Request::get('status')==APPROVED) selected @endif>{{tr('approved')}}</option>
                <option value="{{DECLINED}}" @if(Request::get('status')==DECLINED && Request::get('status')!='' ) selected @endif>{{tr('pending')}}</option>
            </select> 

            <select class="form-control select-width input-space" name="video_type">
                <option value="">{{tr('select_status')}}</option>
                <option value="{{PAID_STATUS}}" @if(Request::get('video_type')==PAID_STATUS) selected @endif>{{tr('paid_video')}}</option>
                <option value="{{NO}}" @if(Request::get('video_type')==NO && Request::get('video_type')!='' ) selected @endif>{{tr('free_video')}}</option>
            </select> 

            <button type="submit" class="btn btn-default pull-right">
                <span class="glyphicon glyphicon-search"> {{tr('search')}}</span>
            </button>

            <a class="btn btn-default box-left" href="{{route('admin.videos')}}">{{tr('clear')}}</a>

        </div>

    </form>

</div>