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
        $appends = [];

        if($request->subcat){
            $appends["subcat"] = "issubcat";
            $products = Products::where("category_id", $categories->id)
                                    ->orderBy($this->column, $this->direction)
                                    ->paginate(5);
            $sort_action = "/$categories->id?subcat=issubcat";
        }
        else{
            $products = Categories::join('products', 'categories.id', '=', 'products.category_id')
                                ->with('children')
                                ->where('parent_id', $categories->id)
                                ->orderBy($this->column, $this->direction)
                                ->paginate(5);
            
            $sort_action = "/$categories->id";
        }

        $products->appends($this->appends);

        return view("products",[
            "products" => $products,
            "sort_action" => $sort_action
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
            "search" => $search
        ]);
    }
}
