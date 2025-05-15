<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupons extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'min_subtotal',
        'expires_at',
    ];

     protected $casts = [
        'expires_at' => 'date',       // ou 'datetime'
    ];
}
