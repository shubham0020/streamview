<div class="col-xs-12 mb-2 bottom-space">

    <form class="col-sm-6 col-sm-offset-6" action="{{route('admin.coupons.index')}}" method="GET" role="search">
        @csrf
        <div class="flex right-box">
            <input type="text" value="{{Request::get('search_key')??''}}" class="form-control search_input input-space" name="search_key" placeholder="{{tr('coupon_search_placeholder')}}">

            <select class="form-control  input-space" name="amount_type">
                <option value="">{{tr('select_amount_type')}}</option>
                <option value="{{YES}}" @if(Request::get('amount_type')==YES) selected @endif>{{tr('absoulte_amount')}}</option>
                <option value="{{NO}}" @if(Request::get('amount_type')==NO && Request::get('amount_type')!='' ) selected @endif>{{tr('percentage')}}</option>
            </select> 
            

            <button type="submit" class="btn btn-default pull-right">
                <span class="glyphicon glyphicon-search"> {{tr('search')}}</span>
            </button>


            <a class="btn btn-default box-left" href="{{route('admin.coupons.index')}}">{{tr('clear')}}</a>
           

        </div>

    </form>

</div>