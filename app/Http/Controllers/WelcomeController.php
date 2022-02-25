<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $kategori = ProductCategory::orderBy("nama", "ASC")->get();
        return view("welcome",["title"=>"BANBRAND","kategori"=>$kategori]);
    }
}
