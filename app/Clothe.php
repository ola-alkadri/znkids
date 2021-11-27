<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clothe extends Model
{
    public function category()
    {
        return $this->belongsTo(category::class);
    }
}
