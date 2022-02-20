<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
    protected $fillable = [
        'product_id',
        'path',
    ];

    /**
     * Product relationship
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
