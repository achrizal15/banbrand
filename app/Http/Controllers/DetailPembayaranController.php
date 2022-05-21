<?php

namespace App\Http\Controllers;

use App\Models\checkout;
use Illuminate\Http\Request;

class DetailPembayaranController extends Controller
{
    public function index()
    {
        $user = auth()->guard("customers")->user();
        $pesanan = new checkout();
        $pesanan = $pesanan->orderBy("id","desc")->where("customer_id", $user->id)->get();
        return view("detail_pembayaran", ["title" => "Detail Pembayaran", "user" => $user, 'pesanan' => $pesanan]);
    }
    public function batal_pesanan(checkout $checkout){
        $checkout->update(["status"=>"Batal"]);
     return   redirect()->route("detail_pembayaran.index");

    }
}
