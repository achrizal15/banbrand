<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $title="Dashboard";
        return view("das.seller.index",["title"=>$title]);
    }
}
