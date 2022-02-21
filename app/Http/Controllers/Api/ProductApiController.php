<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class ProductApiController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        try {
            $products = $this->productService->getAllProducts();

            return ProductResource::collection($products);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Erro ao listar os produtos!'
            ]);
        }
    }

    public function update(ProductUpdateRequest $request)
    {
        try {
            $data = $request->all();

            if(!$product = $this->productService->getProductBySku($request->sku)) {
                return response()->json(['message' => 'Produto não encontrado!'], 404);
            }

            if($request->decrement_stock > $product->stock) {
                return response()->json(['message' => 'Esse produto possui estoque inferior ao valor solicitado!'], 400);
            }

            $data['stock'] = $product->stock - $request->decrement_stock;

            $product->update($data);

            return response()->json([
                'message' => 'Solicitação de baixa de produto realizada com sucesso!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Erro ao dar baixa no estoque!'
            ]);
        }
    }

    public function create()
    {

    }
}
