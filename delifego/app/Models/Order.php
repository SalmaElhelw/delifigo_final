<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['restaurant_id', 'customer_name', 'delivery_fee', 'price', 'total_amount', 'taxes', 'location', 'notes', 'voucher', 'payment_method'];
  
    public function restaurnt()
    {
       
        return $this->belongsTo (Restaurant::class);
    
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
