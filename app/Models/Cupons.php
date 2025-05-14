<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupons extends Model
{
    protected $fillable = [
        'code',
        'discount',
        'expires_at',
        'min_subtotal'
    ];
}
