<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Services\CategoryService;
use App\Services\ProductServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Exception;

class ProductController extends Controller
{
    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function list(Request $request)
    {
        $search = $request->get('search');
        $perPage = $request->get('perPage');

        $products = $this->productService->getAllProductsWithMainPhotos($search, $perPage);

        return Inertia::render('Admin/ProductsList', [
            'products' => $products,
        ]);
    }

    public function create(CategoryService $categoryService)
    {
        $category =  $categoryService->getCategoriesWithSubcategories();

        return Inertia::render('Admin/AddProduct', [
            'categories' => $category
        ]);
    }

    public function store(AddProductRequest $request): RedirectResponse
    {
        $request = $request->validated();

        $data = [
            'name' => $request['name'],
            'subcategory_id' => $request['subcategory_id'],
            'description' => $request['description'],
            'price' => $request['price'],
            'quantity' => $request['quantity'],
        ];

        if(!array_key_exists('photos', $request)) {
            $request['photos'] = null;
        }
        $this->productService->saveProduct($data, $request['photos']);
        return to_route('products');
    }

    public function update(Request $request, string $id)
    {
        try{
            $this->productService->updateValue(
                    $id,
                    $request['type'],
                    $request['newValue']
                );
        }catch(Exception $e){
           return response()->json('error with update', 505);
        }

        return response()
            ->json(
                "Successfully updated the $request->type field to $request->newValue",
                 200);
    }
    
}
