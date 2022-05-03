<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cod extends Model
{
    public function getCodIdAttribute() {

        return $this->id;
    }
}
