<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function trainings()
    {
        return $this->belongsToMany('App\\Models\\Training');
    }
}
