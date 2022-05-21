<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\checkout;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        $title="Dashboard";
        return view("das.seller.index",["title"=>$title]);
    }
    public function permintaan(){
        $permintaan=new checkout();
        $permintaan=$permintaan->where("seller_id",auth()->guard("sellers")->user()->id);
        $permintaan=$permintaan->with(["produk","customer","price_product","galery"])->get();
        
        return view("das.seller.permintaan.index",["title"=>"Permintaan","permintaan"=>$permintaan]);
    }
}
