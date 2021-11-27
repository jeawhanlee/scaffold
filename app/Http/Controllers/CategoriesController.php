<?php

namespace App\Http\Controllers;

use App\Model\Products;
use App\Model\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Categories::get()->where("parent_id", "");

        return view("categories",[
            "categories" => $categories
        ]);
    }

    public function getSubCategory(Categories $categories){
        $sub_cat = Categories::get()->where("parent_id", $categories->id);

        return view("sub_categories",[
            "parent_cat" => $categories->name,
            "sub_cats" => $sub_cat
        ]);
    }
}
