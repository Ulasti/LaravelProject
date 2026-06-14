<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'keywords',
        'description',
        'slug',
        'price',
        'quantity',
        'min_quantity',
        'tax_included',
        'image',
        'status',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function related(int $limit = 4)
    {
        return $this->where('category_id', $this->category_id)
            ->where('id', '!=', $this->id)
            ->where('status', 1)
            ->inRandomOrder()
            ->withAvg(['reviews as reviews_avg_rating' => fn($q) => $q->where('status', 'approved')], 'rating')
            ->withCount(['reviews as reviews_count' => fn($q) => $q->where('status', 'approved')])
            ->limit($limit)
            ->get();
    }

    public function imageUrl(): string
    {
        if (Str::startsWith($this->image, 'http')) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }
}
