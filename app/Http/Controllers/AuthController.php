<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class AuthController extends Controller
{
    private $ROLE = ["admin-bb", "sellers", "customer"];
    public function index($params)
    {
        $params = strtolower($params);
        if (!in_array($params, $this->ROLE)) {
            abort("404");
        }
        if ($params == "sellers") {
            return view("auth.sellers.login", ["title" => "Login Seller"]);
        }
    }
    public function register($params)
    {
        $params = strtolower($params);
        if (!in_array($params, $this->ROLE)) {
            abort("404");
        }
        if ($params == "sellers") {
            return view("auth.sellers.register", ["title" => "Register Seller"]);
        }
    }
}
