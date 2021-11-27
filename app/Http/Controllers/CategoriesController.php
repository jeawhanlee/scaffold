<?php

namespace App\Http\Controllers;

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
}
