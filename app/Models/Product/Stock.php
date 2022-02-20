<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'product_id',
        'type',
        'amount',
        'note'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
