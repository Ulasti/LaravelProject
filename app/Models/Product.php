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

    public function imageUrl(): string
    {
        if (Str::startsWith($this->image, 'http')) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }
}
