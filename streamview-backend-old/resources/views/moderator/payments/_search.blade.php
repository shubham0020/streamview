<div class="col-xs-12 mb-2 bottom-space">

    <form class="col-sm-6 col-sm-offset-6" action="{{route('moderator.revenues.ppv_payments')}}" method="GET" role="search">
        @csrf
        <div class="flex right-box">
            <input type="text" value="{{Request::get('search_key')??''}}" class="form-control search_input input-space" name="search_key" placeholder="{{tr('ppv_payments_search_placeholder')}}">

            <select class="form-control select-width input-space" name="status">
                <option value="">{{tr('select_status')}}</option>
                <option value="{{YES}}" @if(Request::get('status')==YES) selected @endif>{{tr('paid')}}</option>
                <option value="{{NO}}" @if(Request::get('status')==NO && Request::get('status')!='' ) selected @endif>{{tr('unpaid')}}</option>
            </select> 

            <button type="submit" class="btn btn-default pull-right">
                <span class="glyphicon glyphicon-search"> {{tr('search')}}</span>
            </button>


            <a class="btn btn-default box-left" href="{{route('moderator.revenues.ppv_payments')}}">{{tr('clear')}}</a>
           

        </div>

    </form>

</div>