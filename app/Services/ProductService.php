<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductService
{
    protected $productService;

    public function __construct(ProductRepositoryInterface $productService)
    {
        $this->productService = $productService;
    }

    public function getAllProducts()
    {
        return $this->productService->getAllProducts();
    }

    public function getProductBySku($sku)
    {
        return $this->productService->getProductBySku($sku);
    }
}
