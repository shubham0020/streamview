<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    //
    protected $hidden = ['deleted_at', 'unique_id'];

	protected $appends = ['card_id'];

    public function getCardIdAttribute() {

        return $this->id;
    }
}
