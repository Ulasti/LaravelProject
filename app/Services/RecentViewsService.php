<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class RecentViewsService
{
    public static function add(int $productId): void
    {
        $views = session('recent_views', []);

        $views = array_filter($views, fn($id) => $id !== $productId);

        array_unshift($views, $productId);

        $views = array_slice($views, 0, 12);

        session(['recent_views' => $views]);
    }

    public static function ids(): array
    {
        return session('recent_views', []);
    }

    public static function products(int $limit = 6): Collection
    {
        $ids = array_slice(self::ids(), 0, $limit);

        if (empty($ids)) {
            return collect();
        }

        $idsOrder = implode(',', $ids);

        return Product::whereIn('id', $ids)
            ->where('status', 1)
            ->orderByRaw("FIELD(id, {$idsOrder})")
            ->withAvg(['reviews as reviews_avg_rating' => fn($q) => $q->where('status', 'approved')], 'rating')
            ->withCount(['reviews as reviews_count' => fn($q) => $q->where('status', 'approved')])
            ->get();
    }

    public static function count(): int
    {
        return count(self::ids());
    }
}
