<?php

namespace App\Http\Controllers;

use App\Model\Products;
use App\Model\Categories;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProduct(Categories $categories){
        $products = Products::where("category_id", $categories->id)->paginate(5);

        return view("products",[
            "products" => $products
        ]);
    }

    public function productView(Products $product){
        
        return view("product",[
            "product" => $product
        ]);
    }

    public function searchProducts(Request $request){

        $search = $request->input('search');

        // Search in the name and description columns
        $products = Products::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->paginate(5);

        $products->appends(['search' => $search]);

        return view("search",[
            "products" => $products,
            "search" => $search
        ]);
    }
}
