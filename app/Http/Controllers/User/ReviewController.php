<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.review.index', compact('reviews'));
    }

    public function edit(Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            abort(404);
        }

        return view('user.review.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            abort(404);
        }

        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:5000',
        ]);

        $review->update($data);

        return redirect()->route('user.review.index')->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            abort(404);
        }

        $review->delete();

        return redirect()->route('user.review.index')->with('success', 'Review deleted successfully.');
    }
}
