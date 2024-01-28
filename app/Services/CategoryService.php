<?php

namespace App\Services;

use App\Models\Category;
use App\Models\DetalsOrder;
use App\Models\SubCategory;
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

    public function createCategory($parentId, $data)
    { 
        if ($parentId) {
            SubCategory::create([
                'category_id' => $data['parentId'],
                'name' => $data['name'],
                'description' => $data['description'], 
            ]);
        } else {
            Category::create($data);
        }
      
        return redirect()->back();
    }

    public function editCategory($parentId, $data)
    {
        if ($parentId ) {
            $category = Category::find($data['parentId']);
            $subCategory = $category->subCategory->find($data['id']);
            $subCategory->update([
                'name' => $data['name'],
                'description' => $data['description']
            ]);
        } else {
            $category = Category::find($data['id']);
            $category->update([
                'name' => $data['name'],
                'description' => $data['description']
            ]);
        }
        return redirect()->back();
    }

    public function deleteCategory($id, $parentId = null)
    {
        
        if(!$parentId){
            $categories = Category::with('subCategory')
                ->find($id);
    
            if ($categories) {
                $categories->subCategory
                    ->each(function ($subCategory) {
                        $subCategory->delete();
                    });
            }
            $categories->delete();

        } else {
            Category::with('subCategory')
                ->find($parentId)
                ->subCategory
                ->find($id)
                ->delete();   
        }
        
        return redirect()->back();
    }




}
