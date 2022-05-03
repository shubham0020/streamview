<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{

    protected $appends = ['user_payment_id','subscription_amount_formatted','wallet_amount_formatted','coupon_amount_formatted'];


    public function getUserPaymentIdAttribute() {

        return $this->id;
    }

    public function getSubscriptionAmountFormattedAttribute() {

        return formatted_amount($this->subscription_amount);
    }

    public function getWalletAmountFormattedAttribute() {

        return formatted_amount($this->wallet_amount);
    }

    public function getCouponAmountFormattedAttribute() {

        return formatted_amount($this->coupon_amount);
    }


    public function adminVideo() {
        return $this->belongsTo('App\AdminVideo');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function subscription() {
    	return $this->belongsTo('App\Subscription');
    }

   
}