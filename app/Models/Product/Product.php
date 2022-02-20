<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'sku',
        'title',
        'price',
        'stock',
        'active',
        'image',
        'description',
        'added_via',
        'removed_via',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Relationship with image
     */
    public function image()
    {
        return $this->hasOne(ImageProduct::class);
    }

    /**
     * Relationship with stock
     */
    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
