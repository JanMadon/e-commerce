<?php

namespace App\Services;

use App\Models\Category;

class CategoryService {

    public function getCategoriesWithSubcategories() {
        return Category::with('subCategory')->get();
    }

}