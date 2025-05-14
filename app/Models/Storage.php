<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $table = 'storage';

    protected $fillable = [
        'product_id',
        'variation',
        'quantity'
    ];

    public function products()
    {
        return $this->belongsTo(Products::class);
    }
}
