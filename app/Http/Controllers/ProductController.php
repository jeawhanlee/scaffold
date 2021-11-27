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
        $search = $request->search;
        $allowed_sorts = ["name_asc","name_desc","price_asc","price_desc"];

        $column = "id";
        $direction = "DESC";

        $appends = ["search" => $search];

        if($request->sort){
            if(!in_array($request->sort, $allowed_sorts)){
                return response('Not Allowed', 500);
            }

            $appends["sort"] = $request->sort;

            switch ($request->sort){
                case "name_asc":
                    $column = "name";
                    $direction = "ASC";
                break;

                case "name_desc":
                    $column = "name";
                    $direction = "DESC";
                break;

                case "price_asc":
                    $column = "price";
                    $direction = "ASC";
                break;

                case "price_desc":
                    $column = "price";
                    $direction = "DESC";
                break;
            }
        }

        // Search in the name and description columns
        $products = Products::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->orderBy($column, $direction)
            ->paginate(5);

        $products->appends($appends);

        return view("search",[
            "products" => $products,
            "search" => $search
        ]);
    }
}
