<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $product=Product::all();
        return view("das.admin.product.index",[
            "title" => "Product",
            "products"=>$product
        ]);
    }
    public function show(Product $product){
      
        return view("das.admin.product.show",[
            'title'=>"Product",
            "produk"=>$product
        ]);
    }
}
