<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type = auth()->user()->type;
        $products = $this->productService->all($type);
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->store($request?->product,$request->validated());
        if ($request->hasFile('image')) {
            $product->addMediaFromRequest('image')->toMediaCollection('image');
        }
        return ProductResource::make($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->productService->show($id);
        return ProductResource::make($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->productService->destroy($id);
        return response()->json(['message' => "Done"],200);
    }
}
