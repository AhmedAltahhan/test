<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductUser;

class ProductService
{
    // to show all products active
    public function all($type)
    {
        $products = Product::whereIs_active(1)->get();
        if($type == 'gold')
        {
            foreach($products as $product)
                $product->price = $product->price - ($product->price * 0.25) ;
        }
        else if($type == 'silver')
        {
            foreach($products as $product)
                $product->price = $product->price - ($product->price * 0.15) ;
        }
        return $products;
    }

    // to update or create product
    public function store($id,$data)
    {
        $product = Product::updateOrCreate(['id' =>$id],$data);
        return $product;
    }

    // to show a product
    public function show(string $id)
    {
        $product = Product::whereIs_active(1)->findOrFail($id);
        return $product;
    }

    // to delete a product
    public function destroy(string $id)
    {
        Product::whereId($id)->delete();
    }
}
