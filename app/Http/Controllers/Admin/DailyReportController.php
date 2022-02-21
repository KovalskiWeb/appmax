<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DailyReportController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $currentDate = date('d/m/Y', strtotime(Carbon::now()->toDateString()));
        $productCreatedAt = $this->productRepository->getProductDay('created_at');
        $productDeletedAt = $this->productRepository->getProductDay('deleted_at');
        $productCreateInSystem = $this->productRepository->getProductCreateInDevice('system');
        $productCreateInApi = $this->productRepository->getProductCreateInDevice('Api');
        $productLowStock = $this->productRepository->getLowStock();

        return view('admin.administration.reports.index', compact('currentDate', 'productCreatedAt', 'productDeletedAt', 'productCreateInSystem', 'productCreateInApi', 'productLowStock'));
    }
}
