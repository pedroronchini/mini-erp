<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $table = 'storage';

    protected $fillable = [
        'products_id',
        'variacao',
        'quantidade'
    ];

    public function products()
    {
        return $this->belongsTo(Products::class);
    }
}
