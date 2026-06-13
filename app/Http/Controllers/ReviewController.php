<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:5000',
        ]);

        Review::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'rating' => $data['rating'],
            'review' => $data['review'],
        ]);

        return redirect()->route('product.detail', $product->slug)
            ->with('review_sent', true);
    }
}
