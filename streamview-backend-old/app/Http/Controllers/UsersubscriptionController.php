<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\UserPayment;

use App\PayPerView;

use App\Admin;

use App\Store;

class UsersubscriptionController extends Controller
{
    public function saveData(Request $req){

        $coddata = new UserPayment;
        $coddata->subscription_id=$req->subscription_id;
        $coddata->payment_id=$req->transactionID;
        $coddata->amount=$req->amount;
        $coddata->subscription_amount=$req->amount;
        $coddata->user_id=$req->userid;
        $coddata->QR_Expiry_date=$req->expiry;
        $coddata->store_id=$req->storeid;
        $coddata->payment_mode=$req->payment_mode;
    
        $coddata->save();

        //return redirect('admin');
        // return redirect('v4/subscriptions_payment');
    }

    public function payperView(Request $req){
        $payperview_data = new PayPerView;
        $payperview_data->user_id=$req->userid;
        $payperview_data->video_id=$req->video_id;
        $payperview_data->payment_id=$req->transactionID;
        $payperview_data->amount=$req->amount;
        $payperview_data->admin_amount=$req->amount;
        $payperview_data->ppv_amount=$req->amount;
        $payperview_data->type_of_user=$req->type_of_user;
        $payperview_data->QR_Expiry_date=$req->expiry;
        $payperview_data->payment_mode=$req->payment_mode;
        $payperview_data->type_of_subscription=$req->type_of_subscription;
        $payperview_data->store_id=$req->storeid;
        $payperview_data->save();

    }


    public function storeUsers()
    {
        $store_users = Admin::where('role', STORE)->get();
        $username = $store_users[1]->name;
        //dd($username);
        $response_array = ['success'=>true, 'data'=>$store_users];

        return response()->json($response_array,200);
        
        
    }
}
