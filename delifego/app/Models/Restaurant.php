<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
  use HasFactory;
  
  protected $fillable = ['name', 'type', 'location', 'phone_num'];
 
  public function meals()
  {
       return $this->hasMany(Meal::class);
  }

public function orders()

{
   return $this->hasMany(Order::class);
}

}

