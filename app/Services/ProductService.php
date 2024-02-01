<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class ProductService implements ProductServiceInterface
{
    public function getAllProductsWithMainPhotos(
        ?string $search = null,
        ?int $perPage = 10,
        ?string $category = null,
        ?string $subcategory = null,
    ) :LengthAwarePaginator
     {
        !$perPage ? $perPage=10:'';

        if ($search) {
            $query = Product::where('name', 'like', "%$search%");
        } elseif ($subcategory) {
            $query = Product::whereHas('subcategory', function ($query) use ($subcategory) {
                $query->where('name', $subcategory);
            });
        } elseif ($category) {
            $query = Product::whereHas('subcategory.category', function ($query) use ($category) {
                $query->where('name', $category);
            });
        } else {
            $query = Product::select();
        }

        $products = $query->paginate($perPage);

        foreach ($products as $product) {
            $photoNames = Storage::files("product/$product->id");
            if($photoNames) {
                $photoName = basename($photoNames[0]);
                $photo = Storage::get("product/$product->id/$photoName");
                $base64Image = base64_encode($photo);
                $product->photo = $base64Image;
            } else {
                $photo = Storage::get("product/notFound/photo.png");
                $base64Image = base64_encode($photo);
                $product->photo = $base64Image;
            }
        }
        return $products;
    }

    public function getProduct(int $id)
    {

        $product = Product::with('subcategory.category')->find($id);
        $photosNames = Storage::files("product/$id");
        $photosNames = array_map('basename', $photosNames);

        foreach ($photosNames as $photoName) {
            $photo = Storage::get("product/$id/$photoName");
            $base64Image = base64_encode($photo);
            $photosData[] = $base64Image;
            
        }
        $product->photos = $photosData;
        return $product;
    }

    public function saveProduct(array $data, ?array $photos)
    {
        $product = Product::create($data);
        $productId = $product->id;
        $product->id;

        if($photos){
            foreach ($photos as $photo) {
                Storage::put("product/$productId", $photo[0]);
            }
        }

        return;
    }

    public function updateValue(int $productId, string $type, $value)
    {
        $product = Product::find($productId);
        if ($type === 'quantity') {
            $product->update(['quantity' => $value]);
        } elseif ($type === 'status') {
            $product->update(['status' => $value]);
            $product->save();
        } else {
        }
    }
}
