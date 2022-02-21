<?php

namespace App\Repositories;

use App\Models\Product\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    protected $entity;

    public function __construct(Product $entity)
    {
        $this->entity = $entity;
    }

    public function getAllProducts()
    {
        return $this->entity::orderBy('title', 'asc')->get();
    }

    public function getProductBySku(int $sku)
    {
        return $this->entity::where('sku', $sku)->first();
    }
}
