<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{


    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }
}
