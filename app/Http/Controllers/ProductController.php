<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{

    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function list()
    {
        $products = $this->productService->getAllProductsWithMainPhotos();

        return Inertia::render('Admin/ProductsList', [
            'products' => $products,
        ]);
    }

    public function create(Request $request)
    {
        return Inertia::render('Admin/AddProduct', [
            'message' => $request->message
        ]);
    }

    public function store(AddProductRequest $request)
    {
        $request = $request->validated();

        $data = [
            'name' => $request['name'],
            'category' => $request['category'],
            'description' => $request['description'],
            'price' => $request['price'],
            'quantity' => $request['quantity'],
        ];

        $this->productService->saveProduct($data, $request['photos']);

        return to_route('products');
    }

    public function update(Request $request, string $id)
    {
        $request = $request->validate([
            'idd' => ['required']
        ]);
        if(Product::find($id)){
            $this->productService->updateValue(
             $id,
             $request['type'],
             $request['newValue']
             );
        } else {
            //exception
        }
        
        return redirect()->back();
    }
    
}
