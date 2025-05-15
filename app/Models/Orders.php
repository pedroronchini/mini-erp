<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'items',
        'subtotal',
        'shipping_cost',
        'total',
        'customer_name',
        'customer_email',
        'address'
    ];

    protected $casts = ['items'=>'array'];
}
