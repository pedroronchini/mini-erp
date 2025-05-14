<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'items',
        'subtotal',
        'shipping',
        'total',
        'status',
        'delivery_address'
    ];

    protected $casts = ['items' => 'array'];
}
