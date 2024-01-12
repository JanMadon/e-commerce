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

    public function amount()
    {
        $detals = $this->detalsOrder;

        $sum = 0;

        foreach($detals as $detal)
        { 
            $sum += ($detal->product->price * $detal->quantity);
           

        }
        dd($sum  );


        return 2;
    }

}
