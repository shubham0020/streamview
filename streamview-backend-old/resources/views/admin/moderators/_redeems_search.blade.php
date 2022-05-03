<div class="col-xs-12 mb-2 bottom-space">
    <form class="col-sm-6 col-sm-offset-6" action="{{route('admin.moderators.redeems')}}" method="GET" role="search">
        @csrf
        <div class="flex right-box">
            <input type="text" value="{{Request::get('search_key')??''}}" class="form-control search_input input-space" name="search_key" placeholder="{{tr('redeem_search_placeholder')}}">

            <select class="form-control select-width input-space" name="status">
                <option value="">{{tr('select_status')}}</option>
                <option value="{{REDEEM_REQUEST_SENT}}" @if(Request::get('status')==REDEEM_REQUEST_SENT && Request::get('status')!='') selected @endif>{{tr('REDEEM_REQUEST_SENT')}}</option>
                <option value="{{REDEEM_REQUEST_PROCESSING}}" @if(Request::get('status')==REDEEM_REQUEST_PROCESSING && Request::get('status')!='' ) selected @endif>{{tr('REDEEM_REQUEST_PROCESSING')}}</option>
                <option value="{{REDEEM_REQUEST_PAID}}" @if(Request::get('status')==REDEEM_REQUEST_PAID && Request::get('status')!='' ) selected @endif>{{tr('REDEEM_REQUEST_PAID')}}</option>
                <option value="{{REDEEM_REQUEST_CANCEL}}" @if(Request::get('status')==REDEEM_REQUEST_CANCEL && Request::get('status')!='' ) selected @endif>{{tr('REDEEM_REQUEST_CANCEL')}}</option>


            </select> 

            <button type="submit" class="btn btn-default pull-right">
                <span class="glyphicon glyphicon-search"> {{tr('search')}}</span>
            </button>

            <a class="btn btn-default box-left" href="{{route('admin.moderators.redeems')}}">{{tr('clear')}}</a>

        </div>

    </form>

</div>