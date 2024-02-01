<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Inertia\Inertia;

class CategoryController extends Controller
{

    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getCategoriesWithSubcategories();
        return Inertia::render('Admin/Categories', [
            'categories' => $categories,
        ]);
    }

    public function create(CreateCategoryRequest $request)
    {

        $data = $request->validated();
        $this->categoryService->createCategory($request->input('parentId'), $data);
        return redirect()->back();
    }

    public function edit(UpdateCategoryRequest $request)
    {
        $data = $request->validated();
        $this->categoryService->editCategory($request->input('parentId'), $data);
        return redirect()->back();
    }

    public function delete($id, $parentId = null)
    {
        $this->categoryService->deleteCategory($id, $parentId);
        return redirect()->back();
    }
}
