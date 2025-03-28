<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\ProductServiceInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LayoutController extends Controller
{
    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService) {
        $this->productService = $productService;
    }

    public function showProductsBoard(Request $request, $category, $subcategory = null): Response
    {

        $search = $request->query('search');

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
