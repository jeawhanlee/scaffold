<?php

namespace App\Http\Controllers;

use App\Model\Products;
use App\Model\Categories;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProduct(Categories $categories){
        $products = Products::get()->where("category_id", $categories->id);

        return view("products",[
            "products" => $products
        ]);
    }

    public function productView(Products $product){
        
        return view("product",[
            "product" => $product
        ]);
    }
}
