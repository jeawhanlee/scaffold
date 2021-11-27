<?php

namespace App\Http\Controllers;

use App\Model\Products;
use App\Model\Categories;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $column = "products.id";
    private $direction = "DESC";
    private $appends = [];

    public function __construct(Request $request){
        $allowed_sorts = ["name_asc","name_desc","price_asc","price_desc"];

        if($request->sort){
            if(!in_array($request->sort, $allowed_sorts)){
                return response('Not Allowed', 500);
            }

            $this->appends["sort"] = $request->sort;

            switch ($request->sort){
                case "name_asc":
                    $this->column = "products.name";
                    $this->direction = "ASC";
                break;

                case "name_desc":
                    $this->column = "products.name";
                    $this->direction = "DESC";
                break;

                case "price_asc":
                    $this->column = "products.price";
                    $this->direction = "ASC";
                break;

                case "price_desc":
                    $this->column = "products.price";
                    $this->direction = "DESC";
                break;
            }
        }
    }

    public function getProduct(Categories $categories, Request $request){

        $sub_cat = "";
        $sub_cat_value = "";
        $sort_action = "/$categories->id";

        if($request->subcat){
            $products = Products::where("category_id", $categories->id)
                                    ->orderBy($this->column, $this->direction)
                                    ->paginate(5);

            $sub_cat = "subcat";
            $sub_cat_value = "issubcat";
        }
        else{
            $products = Categories::join('products', 'categories.id', '=', 'products.category_id')
                                ->with('children')
                                ->where('parent_id', $categories->id)
                                ->orderBy($this->column, $this->direction)
                                ->paginate(5);
        }

        $products->appends($this->appends);

        return view("products",[
            "products" => $products,
            "sort_action" => $sort_action,
            "subcat" => $sub_cat,
            "subcat_value" => $sub_cat_value,
            "sort" => isset($this->appends["sort"]) ? $this->appends["sort"] : ""
        ]);
    }

    public function productView(Products $product){
        
        return view("product",[
            "product" => $product
        ]);
    }

    public function searchProducts(Request $request){
        $search = $request->search;
        

        $this->appends["search"] = $search;

        // Search in the name and description columns
        $products = Products::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->orderBy($this->column, $this->direction)
            ->paginate(5);

        $products->appends($this->appends);

        return view("search",[
            "products" => $products,
            "search" => $search,
            "sort" => isset($this->appends["sort"]) ? $this->appends["sort"] : ""
        ]);
    }
}
