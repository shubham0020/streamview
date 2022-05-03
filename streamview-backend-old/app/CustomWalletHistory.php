<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomWalletHistory extends Model
{
    //

    protected $appends = ['custom_wallet_history_id'];


    public function getCustomWalletHistoryIdAttribute() {

	    return $this->id;
    }
    

}
