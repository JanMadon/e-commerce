<?php

namespace App\Services;

use App\Models\Product;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class ProductService {


    public function getAllProductsWithMainPhotos(int $display = 10)
    {
        $products = Product::whereNot('status', 'deleted')->paginate($display);
        foreach ($products as $product) {
            $photoNames = Storage::files("product/$product->id");
            $photoName = basename($photoNames[0]);
            $photo = Storage::get("product/$product->id/$photoName");
            $base64Image = base64_encode($photo);
            $product->photo = $base64Image;;

        }
        return $products;
    }

    public function saveProduct(array $data, array $photos)
    {
        //dd($data);
        $product = Product::create($data);
        $productId = $product->id;
        $product->id;

        foreach ($photos as $photo) {
            Storage::put("product/$productId", $photo[0]);
        }
        
        return;
    }

    public function updateValue(int $productId, string $type, $value)
    {
            $product = Product::find($productId);
            if($type === 'quantity') {
                $product->update(['quantity' => $value]);
             } elseif($type === 'status') {
                $product->update(['status' => $value]);
                $product->save();
             } else {         
             }
       
    }

}