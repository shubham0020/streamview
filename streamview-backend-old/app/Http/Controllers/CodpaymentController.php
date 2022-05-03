<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cods;

class CodpaymentController extends Controller
{
    public function saveData(Request $req){

        $coddata = new Cods;
        $coddata->email=$req->useremail;
        $coddata->name=$req->username;
        $coddata->amount=$req->amount;
        $coddata->user_id=$req->subscription_id;
        $coddata->save();

        return redirect('admin');
        // return redirect('v4/subscriptions_payment');
    }
}


//  http://localhost:8000/userApi/codpayment?subscription_id=2&useremail=user@email.com&username=user2&amount=30
