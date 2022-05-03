<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomWallet extends Model
{	

    protected $appends = ['custom_wallet_id','total_formatted', 'remaining_formatted', 'used_formatted'];


    public function getCustomWalletIdAttribute() {

	    return $this->id;
    }
    

	// Get User wallet Details
    public function userWalletHistory()
    {
        return $this->hasMany(CustomWalletHistory::class, 'user_id');
    }

    public function getTotalFormattedAttribute() {

	    return formatted_amount($this->total);
	}

	public function getRemainingFormattedAttribute() {

	    return formatted_amount($this->remaining);
	}

    public function getUsedFormattedAttribute() {

	    return formatted_amount($this->used);
	}
	

    public static function boot() {

        parent::boot();

	    static::deleting(function ($model) {

	    	$model->userWalletHistory()->delete();
	    });

	}
}
