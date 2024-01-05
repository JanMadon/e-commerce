<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Models\Product;
use Carbon\Carbon;
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
        
       return Inertia::render('Admin/ProductsList');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function form(Request $request)
    {
    

       return Inertia::render('Admin/AddProduct', [
        'message' => $request->message,
       ]
       
    );
    }

    public function create(AddProductRequest $request) {  
        
        
        $request = $request->validated();
        
        $model = new Product();

        $date = [
            'name' => $request['name'],
            'category'=> $request['category'],
            'description' => $request['description'],
            'price' => $request['price'],
            'quantity' => $request['quantity'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $model->fill($date);
        $model->save();
        $productId = $model->id;

        foreach($request['photos'] as $photo) {
            // $path = $photo[0]->disc('public')->store("products/$productId");
            $path = Storage::put('product',$photo[0]);
            dump($path);
        }


        dd($productId);

       
        return to_route('list.products');
    }

    public function savePhoto(Request $request) {
        dd($request->data);

        Storage::disk('public')->put('./list.txt', '$request->data');
        
        return to_route('form.add.product', ['message' => 'file uploadet successfully']);
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
