<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'delete',
        'discount',
        'category_id'
    ];

    //relación uno a varios desde categorías a productos
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
