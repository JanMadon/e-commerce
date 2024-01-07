<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalsOrder extends Model
{
    use HasFactory;

    protected $table = 'detals_order';
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
    ];
}
