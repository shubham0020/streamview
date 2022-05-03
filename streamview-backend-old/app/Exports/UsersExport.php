<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;
use App\User, App\UserPayment, App\Subscription;
  
class UsersExport implements FromView 
{


     public function __construct(Request $request)
    {
        $this->search_key = $request->search_key;
        $this->status = $request->status;
        $this->sort = $request->sort;
        $this->subscription_id = $request->subscription_id;
        
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View {

        $base_query = User::orderBy('created_at','desc');

            if($this->sort == 'declined') {

                $base_query = $base_query->where('users.is_activated', USER_DECLINED );

            } 

            if($this->subscription_id != '') {

                $user_payments = UserPayment::where('subscription_id' , $this->subscription_id)->pluck('user_id')->toArray();

                foreach ($user_payments as $key => $value) {

                    $user_ids[] = $value;
                }

                $subscription_details = Subscription::find($this->subscription_id);       
                        
                $base_query =  User::whereIn('id' , $user_ids)->orderBy('created_at','desc');

            } 
                $base_query = $base_query->get();

    
     return view('exports.users', [
            'data' => $base_query
        ]);


    }

}