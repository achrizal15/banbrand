<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use SebastianBergmann\Environment\Console;

class AuthController extends Controller
{
    private $ROLE = ["admin-bb", "sellers", "customer"];
    private $kategori = [];
    public function __construct()
    {
        $this->kategori = ProductCategory::orderBy("nama", "ASC")->get();
    }
    public function index($params)
    {
        $params = strtolower($params);
        if (!in_array($params, $this->ROLE)) {
            abort("404");
        }
        if ($params == "sellers") {
            return view("auth.sellers.login", ["title" => "Login Seller", "kategori" => $this->kategori, "subtitle" => "Login Seller"]);
        }
    }
    public function register($params)
    {
        $params = strtolower($params);
        if (!in_array($params, $this->ROLE)) {
            abort("404");
        }
        if ($params == "sellers") {
            return view("auth.sellers.register", ["title" => "Register Seller","kategori" => $this->kategori, "subtitle" => "Register Seller"]);
        }
    }
    public function create($params){
        $params = strtolower($params);
        if (!in_array($params, $this->ROLE)) {
            abort("404");
        }
        if ($params == "sellers") {
            echo json_encode(request()->post());
        }
    }
}
