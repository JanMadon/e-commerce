<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use PhpParser\Node\Stmt\Return_;

use function PHPSTORM_META\map;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {

        $products = Product::get();
        $photosData = [];

        foreach($products as $product) {
            $productId = $product->id;
            $photoName = Storage::files("product/$productId");
            $photoName = array_map('basename', $photoName);
            $photo = Storage::get("product/$productId/$photoName[0]");

            $base64Image = base64_encode($photo);
            $photosData[$productId] = $base64Image;
            
        }
        
        // dump($products);
       return Inertia::render('ProductsList', [
        'products' => $products,
        'photos' => $photosData
       ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function form(Request $request)
    {
    

       return Inertia::render('Admin/AddProduct', [
        'message' => $request->message,
       ]
       
    );
    }

    public function create(AddProductRequest $request) {  
        
        $request = $request->validated();
        
        $model = new Product();

        $date = [
            'name' => $request['name'],
            'category'=> $request['category'],
            'description' => $request['description'],
            'price' => $request['price'],
            'quantity' => $request['quantity'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $model->fill($date);
        $model->save();
        $productId = $model->id;

        foreach($request['photos'] as $photo) {
            // $path = $photo[0]->disc('public')->store("products/$productId");
            $path = Storage::put("product/$productId",$photo[0]);
        }

        return to_route('list.products');
    }

    public function show(string $id)
    {
        
        $photosName = Storage::files("product/$id");
        $photosName = array_map('basename', $photosName);
        //dd($photosName);
        
        $photosData = [];

        foreach($photosName as $photoName) {
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
