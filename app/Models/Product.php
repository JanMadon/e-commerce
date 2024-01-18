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
        'name', 'price', 'subcategory_id', 'description', 'quantity'
    ];

    // public function ordersDetal(): HasOne
    // {
    //     return $this->hasOne(class);
    // }
}
