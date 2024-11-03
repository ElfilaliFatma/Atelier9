<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;
use Validator;
use App\Http\Resources\ProductResource;

class ProductController extends BaseController
{
    public function index()
    {
        return Product::select('id', 'name', 'detail')->get(); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required'
        ]);

        Product::create($request->post());
        return response()->json([
            'message' => 'New item added successfully'
        ]);
    }
    
    public function show(Product $product)
    {
        return response()->json([
            'data' => new ProductResource($product)
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required'
        ]);

        $product->fill($request->post())->update();
        return response()->json([
            'message' => 'Item updated successfully'
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete(); 
        return response()->json([
            'message' => 'Item deleted successfully'
        ]);
    }
}
