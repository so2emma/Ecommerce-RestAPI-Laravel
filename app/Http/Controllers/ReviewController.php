<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReviewRequest;
use App\Http\Requests\UpdateReviewsRequest;
use App\Http\Responses\ApiErrorResponse;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Response;
use App\Http\Responses\ApiSuccessResponse;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $reviews = $product->reviews()->get();
        if ($reviews->isEmpty()) {
            return new ApiErrorResponse(
                "This product has not been reviewed",
                null,
                Response::HTTP_NO_CONTENT
            );
        }

        return new ApiSuccessResponse(
            $reviews,
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
    public function show(Product $product, Review $review)
    {
        if ($review->product_id !== $product->id) {
            return new ApiErrorResponse(
                "The review does not belong to this product",
                null,
                Response::HTTP_NOT_FOUND
            );
        }

        return new ApiSuccessResponse(
            $review,
            ["message" => "Single Review"]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewsRequest $request, Product $product, Review $review)
    {
        if ($review->product_id !== $product->id) {
            return new ApiErrorResponse(
                "The review does not belong to this product",
                null,
                Response::HTTP_NOT_FOUND
            );
        }

        $review->update($request->all());

        return new ApiSuccessResponse(
            $review,
            ["message" => "Review Updated Successfully"]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, Review $review)
    {
        if ($review->product_id !== $product->id) {
            return new ApiErrorResponse(
                "The review does not belong to this product",
                null,
                Response::HTTP_NOT_FOUND
            );
        }

        $review->delete();

        return new ApiSuccessResponse(
            null,
            ['message' => "Product Deleted Successfully"],
            Response::HTTP_NO_CONTENT
        );
    }
}
