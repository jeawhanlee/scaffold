<?php

namespace App\Http\Controllers;

use App\Model\Products;
use App\Model\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Categories::get();

        return view("categories",[
            "categories" => $categories
        ]);
    }

    public function singleCategory(Categories $categories){
        $products = Products::get()->where("category_id", $categories->id);

        return view("products",[
            "products" => $products
        ]);
    }
}
