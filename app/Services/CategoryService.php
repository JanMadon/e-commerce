<?php

namespace App\Services;

use App\Models\Category;
use App\Models\DetalsOrder;
use Illuminate\Support\Facades\DB;

class CategoryService
{

    public function getCategoriesWithSubcategories()
    {
        return Category::with('subCategory')->get();
    }

    public function getMostPopularCategory(): array
    {
        $data = [];
        $mostPopularCategory = DetalsOrder::with('product.subcategory.category')->select('categories.name as category_name', DB::raw('count(*) as order_count'))
            ->join('products', 'detals_order.product_id', '=', 'products.id')
            ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
            ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
            ->groupBy('categories.name')
            ->get();

        foreach ($mostPopularCategory as $categoryCount) {
            $data[$categoryCount->category_name] = $categoryCount->order_count;
        }

        return $data;
    }
}
