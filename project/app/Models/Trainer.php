<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    //


   public function Classes()
    {
    return$this->hasMany(ClassModel::class);
    }

}
