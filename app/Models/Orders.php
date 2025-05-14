<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'itens',
        'subtotal',
        'frete',
        'total',
        'status',
        'endereco_entrega'
    ];

    protected $casts = ['itens' => 'array'];
}
