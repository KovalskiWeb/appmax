<?php

namespace App\Repositories;

use App\Models\Product\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Carbon\Carbon;

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

    public function getProductDay(string $column)
    {
        $currentDate = Carbon::now();

        return $this->entity::query()
        ->whereBetween($column, [$currentDate->toDateString()." 00:00:00", $currentDate->toDateString()." 23:59:59"])
        ->orderBy($column, 'desc')
        ->withTrashed()
        ->get();
    }

    public function getProductCreateInDevice(string $device)
    {
        $currentDate = Carbon::now();

        return $this->entity::query()
        ->where('added_via', $device)
        ->whereBetween('created_at', [$currentDate->toDateString()." 00:00:00", $currentDate->toDateString()." 23:59:59"])
        ->withTrashed()
        ->get();
    }

    public function getLowStock()
    {
        return $this->entity::query()
        ->where('active', 1)
        ->where('stock', '<', 100)
        ->get();
    }
}
