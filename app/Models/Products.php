<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'name',
        'preco',
        'variacoes'
    ];

    protected $casts = [
        'variacoes' => 'array'
    ];

    public function storages()
    {
        return $this->hasMany(Storage::class);
    }
}
