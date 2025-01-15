<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = ['restaurant_id', 'name', 'description', 'price', 'size', 'flavour', 'extras', 'type'];
    public function restaurnts()
    {
        return $this->belongsTo(Restaurant::class);

    }
}
