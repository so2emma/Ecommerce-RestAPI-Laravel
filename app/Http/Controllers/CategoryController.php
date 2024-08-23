<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Responses\ApiSuccessResponse;
use App\Models\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ApiSuccessResponse(
            Category::all(),
            ['message' => "All Categories"]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::Create($request->all());
        return new ApiSuccessResponse(
            $category,
            ['message' => 'Category Created Successfully'],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return new ApiSuccessResponse(
            $category,
            ["message" => "Single Category"]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        return new ApiSuccessResponse(
            $category->update($request->all()),
            ['message' => "Category Updated Successfully"]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return new ApiSuccessResponse(
            null,
            ['message' => "Category Deleted Successfully"]
        );
    }
    
}
