<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use PhpParser\Node\Stmt\Return_;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function form()
    {
       return Inertia::render('Admin/AddProduct');
    }

    public function create(Request $request) {  

        dd($request);
        //return Inertia::render('Admin/AddProduct');
    }

    public function savePhoto(Request $request) {
        //dd($request->data);
        Storage::disk('public')->put('./list.txt', '$request->data');
        
        return response()->json(['message' => 'file uploadet successfully'], 200);
        //return to_route('form.add.product');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
