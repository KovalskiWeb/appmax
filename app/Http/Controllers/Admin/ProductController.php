<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProduct;
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
