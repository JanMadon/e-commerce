<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {

        $categories = Category::with('subCategory')->get();
        return Inertia::render('Admin/Categories', [
            'categories' => $categories,
        ]);
    }

    public function create(CreateCategoryRequest $request)
    {
        $data = $request->validated();

        if ($request->input('parentId')) {
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

    public function edit(UpdateCategoryRequest $request)
    {
        $data = $request->validated();

        if ($request->query('parentId')) {
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

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id, $parentId = null)
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
