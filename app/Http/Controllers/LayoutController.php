<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class LayoutController extends Controller
{

    public function showProdyctBoard()
    {
        $products = Product::get();
        $photosData = [];

        foreach ($products as $product) {
            $productId = $product->id;
            $photoName = Storage::files("product/$productId");
            $photoName = array_map('basename', $photoName);
            $photo = Storage::get("product/$productId/$photoName[0]");

            $base64Image = base64_encode($photo);
            $photosData[$productId] = $base64Image;
        }

        return Inertia::render('MainPage', [
            'products' => $products,
            'photos' => $photosData
        ]);
    }

    public function showProduct(string $id)
    {

        $photosName = Storage::files("product/$id");
        $photosName = array_map('basename', $photosName);
        //dd($photosName);

        $photosData = [];

        foreach ($photosName as $photoName) {
            $photo = Storage::get("product/$id/$photoName");
            $base64Image = base64_encode($photo);

            $photosData[] = $base64Image;
        }
        //dd($photosData[0]);

        return Inertia::render('ProductPage', [
            'product' => Product::find($id),
            'photos' => $photosData
        ]);
    }

    public function getCategory(Request $request)
    {
        $category = Category::with('subCategory')->get();
        
        //return redirect()->back()->with(['view'=> $category]);
        return response()->json($category);
    }


}
