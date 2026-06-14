<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Collection;

class WishlistService
{
    public static function toggle(int $productId): bool
    {
        if ($user = auth()->user()) {
            $exists = Wishlist::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->exists();

            if ($exists) {
                Wishlist::where('user_id', $user->id)
                    ->where('product_id', $productId)
                    ->delete();
                return false;
            }

            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
            return true;
        }

        $wishlist = session('wishlist', []);

        if (in_array($productId, $wishlist)) {
            $wishlist = array_values(array_filter($wishlist, fn($id) => $id !== $productId));
            session(['wishlist' => $wishlist]);
            return false;
        }

        $wishlist[] = $productId;
        session(['wishlist' => $wishlist]);
        return true;
    }

    public static function isWishlisted(int $productId): bool
    {
        if ($user = auth()->user()) {
            return Wishlist::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->exists();
        }

        return in_array($productId, session('wishlist', []));
    }

    public static function ids(): array
    {
        if ($user = auth()->user()) {
            return Wishlist::where('user_id', $user->id)
                ->pluck('product_id')
                ->toArray();
        }

        return session('wishlist', []);
    }

    public static function products(): Collection
    {
        $ids = self::ids();

        if (empty($ids)) {
            return collect();
        }

        return Product::whereIn('id', $ids)
            ->where('status', 1)
            ->withAvg(['reviews as reviews_avg_rating' => fn($q) => $q->where('status', 'approved')], 'rating')
            ->withCount(['reviews as reviews_count' => fn($q) => $q->where('status', 'approved')])
            ->get();
    }

    public static function count(): int
    {
        return count(self::ids());
    }
}
