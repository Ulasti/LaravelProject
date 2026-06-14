<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'image',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function imageUrl(): string
    {
        if (Str::startsWith($this->image, 'http')) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }
}
