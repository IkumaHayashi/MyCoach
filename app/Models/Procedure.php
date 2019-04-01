<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    //

    public function training()
    {
        return $this->belognsTo('App\\Trainng');
    }
}
