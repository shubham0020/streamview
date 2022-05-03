<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redeem extends Model
{

    protected $appends = ['redeem_id','total_moderator_amount_formatted', 'total_admin_amount_formatted', 'remaining_formatted', 'paid_formatted'];

    protected $hidden = ['id'];

    public function moderator() {
    	return $this->belongsTo('App\Moderator');
    }

    public function getRedeemIdAttribute() {

	    return $this->id;
	}


    public function getTotalAdminAmountFormattedAttribute() {

	    return formatted_amount($this->total_admin_amount);
    }
    
    public function getTotalModeratorAmountFormattedAttribute() {

	    return formatted_amount($this->total_moderator_amount);
	}

	public function getRemainingFormattedAttribute() {

	    return formatted_amount($this->remaining);
	}

	public function getPaidFormattedAttribute() {

	    return formatted_amount($this->paid);
	}
}
