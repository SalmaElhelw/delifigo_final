<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    //
    protected $fillable=['class','start_date',''];

public function trainer()
{
     return $this->belongsTo(Trainer::class);
}

public function bookings()
{
    return $this->HasMany(Booking::class);
}

}


