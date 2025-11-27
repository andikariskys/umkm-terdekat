<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'customer_name', 'customer_phone', 'total_amount', 'tax', 'status'];

    // Relasi ke Item
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relasi ke Pemilik Toko (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
