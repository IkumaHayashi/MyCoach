<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use CompositePrimaryKeyTrait;

    public $timestamps = false;
    protected $primaryKey = ['training_id', 'user_id' ];
    public $incrementing = false;



    public function Training()
    {
        return $this->belongsTo('App\\Models\\Training');
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

}
