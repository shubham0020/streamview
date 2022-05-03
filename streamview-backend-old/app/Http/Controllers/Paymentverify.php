<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User, App\Moderator, App\UserPayment;
class Paymentverify extends Controller
{
    public function Payment(Request $request) {

        $subscription = Subscription::find($request->subscription_id);

        $user = User::find($request->email);

       $Payment_method = $user->payment_mode;

       if($Payment_method == 'COD')
       {
           
        $user_payment = new $user;
        $user_payment = $request->amount;
        $user_payment = $request->transaction_id;
        $user_payment = $user->email;

        $user_payment->save();

        if ($user_payment) {

            $user = User::find($user_payment->user_id);

            $user->amount_paid += $total;

            $user->expiry_date = $user_payment->expiry_date;

            $user->no_of_days = 0;

            $user->user_type = DEFAULT_TRUE;

            $user->payment_mode = 'COD';

            $user->save();

        }
        else{
            $error_message = tr('payment_not_done');
        }

       }
}

}
