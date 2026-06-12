<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'parent_id',
        'title',
        'keywords',
        'description',
        'image',
        'status',
    ];
}
