<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupons extends Model
{
    protected $fillable = [
        'codigo',
        'desconto',
        'validade',
        'min_subtotal'
    ];
}
