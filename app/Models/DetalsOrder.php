<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DetalsOrder extends Model
{
    use HasFactory;

    protected $table = 'detals_order';
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
    ];


    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    } 
}
