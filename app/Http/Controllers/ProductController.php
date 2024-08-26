<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Responses\ApiSuccessResponse;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Responses\ApiErrorResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ApiSuccessResponse(
            Product::all(),
            ['message' => "List of all Product"]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {

        $category = Category::find($request->category_id);

        if(!$category){
            return new ApiErrorResponse("Category cannot be found", null, Response::HTTP_NOT_FOUND);
        }

        $product = Product::Create($request->all());

        return new ApiSuccessResponse(
            $product,
            ['message' => 'Product Created Successfully'],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ApiSuccessResponse(
            $product,
            ["message" => "Single Category"]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());

        return new ApiSuccessResponse(
            $product,
            ['message' => 'Product updated successfully']
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return new ApiSuccessResponse(
            null,
            ['message' => "Product Deleted Successfully"],
            Response::HTTP_NO_CONTENT
        );
    }
}
