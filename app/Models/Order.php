<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
    ];

    // public function product(): BelongsToMany
    // {
    //     return $this->belongsToMany(Product::class);
    // }

    public function detalsOrder(): HasMany
    {
        return $this->hasMany(DetalsOrder::class);
    }

    public function amount(): Int 
    {
        $sum = 0;
        $detals = $this->detalsOrder;
        foreach($detals as $detal)
        { 
            $sum += ($detal->product->price * $detal->quantity);
        }

        switch($this->shiping_method) {
            case 'locker':
                $shipmentCost = 10;
                break;
            case 'curier':
                $shipmentCost = 20;
                break;
            default:
                $shipmentCost = 0;       
        }

        return $sum + $shipmentCost;
    }

    public function productsNameAndQuantity(): Array
    {
        $detals = $this->detalsOrder;
        $products=[];

        foreach($detals as $detal)
        { 
            array_push($products, $detal->quantity . 'pcs: ' . $detal->product->name . '. ');
        }
        return $products;
    }

}
