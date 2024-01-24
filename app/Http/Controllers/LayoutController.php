<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class LayoutController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }

    public function showProdyctBoard(Request $rquest)
    {
        $category = $rquest->route('category');
        $subcategory = $rquest->route('subcategory');
        $search = $rquest->query('search');

        $products = $this->productService->getAllProductsWithMainPhotos($search, 8, $category, $subcategory);

        return Inertia::render('MainPage', [
            'products' => $products,
        ]);
    }

    public function showProduct(string $id)
    {
        return Inertia::render('ProductPage', [
            'product' => $this->productService->getProduct($id)
        ]);
    }

    public function getCategory()
    {
        $category = Category::with('subCategory')->get();
        return response()->json($category);
    }


}
