<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $data = Review::with('product', 'user')->latest()->get();
        return view('admin.review.index', compact('data'));
    }

    public function show(Review $review)
    {
        $review->load('product', 'user');
        return view('admin.review.show', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $data = $request->validate([
            'status' => 'required|string|in:pending,approved,rejected',
        ]);

        $review->update($data);

        return redirect()->route('admin.review.index')->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.review.index')->with('success', 'Review deleted successfully.');
    }
}
