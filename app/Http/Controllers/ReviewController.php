<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReviewRequest;
use App\Http\Requests\UpdateReviewsRequest;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Response;
use App\Http\Responses\ApiSuccessResponse;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ApiSuccessResponse(
            Review::all(),
            ['message' => "List of all Reviews"]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateReviewRequest $request, Product $product)
    {
        $review = $product->reviews()->create($request->all());

        return new ApiSuccessResponse(
            $review,
            ["message" => "Review Created Successfully"],
            Response::HTTP_CREATED
        );

    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return new ApiSuccessResponse(
            $review,
            ["message" => "Single Category"]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewsRequest $request, Review $review)
    {
        $review->update($request->all());

        return new ApiSuccessResponse(
            $review,
            ["message" => "Review Updated Successfully"]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return new ApiSuccessResponse(
            null,
            ['message' => "Product Deleted Successfully"],
            Response::HTTP_NO_CONTENT
        );


    }
}
