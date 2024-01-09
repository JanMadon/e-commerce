<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'category', 'description', 'quantity'
    ];


    public function product(): HasOne
    {
        return $this->hasOne(User::class,);
    }

    public function product1(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
