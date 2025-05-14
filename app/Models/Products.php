<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'name',
        'price',
        'variations'
    ];

    protected $casts = ['variations' => 'array'];

    public function storages()
    {
        return $this->hasMany(Storage::class);
    }
}
