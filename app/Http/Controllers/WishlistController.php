<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\WishlistService;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $products = WishlistService::products();

        return view('pages.wishlist', compact('products'));
    }

    public function toggle(Product $product)
    {
        $added = WishlistService::toggle($product->id);

        $key = $added ? 'success' : 'info';
        $message = $added
            ? '"' . $product->title . '" added to wishlist.'
            : '"' . $product->title . '" removed from wishlist.';

        if (request()->wantsJson()) {
            return response()->json([
                'added' => $added,
                'count' => WishlistService::count(),
                'message' => $message,
            ]);
        }

        return redirect()->back()->with($key, $message);
    }
}
