<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RedeemRequest extends Model
{

    protected $appends = ['redeem_request_status_formatted'];

    public function moderator() {
    	return $this->hasOne('App\Moderator', 'id', 'moderator_id');
    }

    public function getRedeemRequestStatusFormattedAttribute() {

        return redeem_request_status($this->status);
    }
}
