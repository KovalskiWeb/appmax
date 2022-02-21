<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProduct;
use App\Http\Requests\Admin\UpdateProduct;
use App\Models\Product\ImageProduct;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private $repository;

    public function __construct(Product $product)
    {
        $this->repository = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->repository->latest()->paginate(10);

        return view('admin.administration.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.administration.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Admin\StoreProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        $data = $request->all();

        $this->json['request'] = $request;
        $this->json['status'] = "create";

        if($product = Product::where('sku', $request->sku)->first()) {
            $this->json['message'] = 'Já existe produto com o SKU informado!';
            return response()->json($this->json);
        }

        $data['added_via'] = 'system';

        $product = $this->repository->create($data);

        if($request->hasFile('image') && $request->image->isValid()) {
            $data['image'] = $request->image->store("public/products/{$product->id}");

            $imageProduct = new ImageProduct();
            $imageProduct->product_id = $product->id;
            $imageProduct->directory = "products/{$product->id}";
            $imageProduct->path = $data['image'];
            $imageProduct->save();
        }

        $this->json['redirect'] = route('admin.products.index');
        return response()->json($this->json);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$product = $this->repository::find($id)) {
            return redirect()->back();
        }

        return view('admin.administration.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Admin\UpdateProduct  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProduct $request, $id)
    {
        if(!$product = $this->repository::find($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        if($request->hasFile('image') && $request->image->isValid()) {
            if($imageProduct = ImageProduct::where('product_id', $request->id)->first()) {
                if (Storage::exists($imageProduct->path)) {
                    Storage::delete($imageProduct->path);
                }

                $imageProduct->path = $request->image->store("public/products/{$request->id}");
                $imageProduct->directory = "products/{$id}";
                $imageProduct->update();
            } else {
                $imageProduct = new ImageProduct();
                $imageProduct->product_id = $request->id;
                $imageProduct->directory = "products/{$request->id}";
                $imageProduct->path = $request->image->store("public/products/{$request->id}");
                $imageProduct->save();
            }
        }

        $product->update($data);

        $this->json['request'] = $request;
        $this->json['status'] = "update";
        $this->json['image_update'] = (!empty($imageProduct->path) ? url('storage/' . $imageProduct->path) : false);


        return response()->json($this->json);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(!$product = $this->repository::find($request->id)) {
            return redirect()->back();
        }

        if($image_products = ImageProduct::where('product_id', $request->id)->first()) {
            if(Storage::exists($image_products->path)) {
                Storage::deleteDirectory($image_products->directory);
            }

            $image_products->delete();
        }

        $product->delete();

        $this->json['success'] = true;
        $this->json['redirect'] = route('admin.products.index');
        return response()->json($this->json);
    }

    /**
     * Search results
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $products = $this->repository
            ->where(function ($query) use ($request) {
                if($request->filter) {
                    $query->orWhere('description', 'LIKE', "%{$request->filter}%");
                    $query->orWhere('title', 'LIKE', "%{$request->filter}%");
                }
            })
            ->latest()
            ->paginate();

        return view('admin.administration.products.index', compact('products', 'filters'));
    }
}
