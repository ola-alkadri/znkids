<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function clothe()
    {
        return $this->hasMany(Clothe::class);
    }
}
