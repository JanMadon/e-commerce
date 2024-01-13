<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{

    public function getCategory(Request $request)
    {
        $category = Category::with('subCategory')->get();
        //dd($category);


        //return redirect()->back()->with(['view'=> $category]);
        return response()->json($category);
    }
    
}
