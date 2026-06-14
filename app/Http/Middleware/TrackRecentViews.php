<?php

namespace App\Http\Middleware;

use App\Models\Product;
use App\Services\RecentViewsService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackRecentViews
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $slug = $request->route('slug');

        if ($slug) {
            $product = Product::where('slug', $slug)->first(['id']);
            if ($product) {
                RecentViewsService::add($product->id);
            }
        }

        return $response;
    }
}
