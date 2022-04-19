<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\checkout;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        $checkout = new checkout();
        $request->file("file")->store("public/checkout");
        $checkout->file = $request->file("file")->hashName();
        $checkout->kodetransfer = $request->kodetransfer;
        $checkout->customer_id = $request->customer_id;
        $checkout->seller_id = $request->seller_id;
        $checkout->price_id = $request->price_id;
        $checkout->produk_id = $request->produk_id;
        $checkout->no_transaksi = $request->no_transaksi;
        $checkout->kontakdarurat = $request->kontakdarurat;
        $checkout->alamat = $request->alamat;
        $checkout->galery_id = $request->galery_id;
        $checkout->pesan = $request->pesan;
        $checkout->pengiriman = $request->pengiriman;
        $checkout->harga = $request->harga;
        $checkout->ongkir = $request->ongkir;
        $checkout->kodetransfer = $request->kodetransfer;
        $checkout->total = $request->total;
        $checkout->expired_at = date("Y-m-d H:i:s", strtotime("12 hours"));
        $checkout->status = "Belum Dibayar";
        $checkout->saveOrFail();
        $response = [
            "message" => "Checkout Berhasil",
            "url" => route("pembayaran", $checkout->id),
        ];
        echo json_encode($response);
    }
    public function pembayaran($id_transaksi)
    {
        $user = auth("customers")->user();
        $checkout = checkout::where("customer_id", $user->id)->where("id", $id_transaksi)->where("expired_at",">=",date("Y-m-d H:i:s",strtotime("now")))->first();
        if (!$checkout) {
            abort(404);
        }
        return view('pembayaran', ["title" => "Pembayaran", "checkout" => $checkout, "subtitle" => "Pembayaran", "user" => $user]);
    }
}
