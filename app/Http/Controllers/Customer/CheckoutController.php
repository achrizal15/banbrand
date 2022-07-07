<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\AdminSetting;
use App\Models\Bank;
use App\Models\checkout;
use App\Models\Notification;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        abort(404);
    }
    public function bukti_bayar(checkout $checkout, Request $request)
    {
        $request->validate([
            'docx' => 'required|image',
        ]);
        $user = auth("customers")->user();
        $request->file('docx')->store("public/bukti_bayar");
        $checkout->update([
            "bukti_bayar" => $request->file('docx')->hashName(),
            "bank_id" => $request->bank_id,
            "no_rekening" => $request->no_rekening,
            "status" => "Dibayar"
        ]);
        $response = [
            "message" => "Pembayaran berhasil diupload",
            "url" => route("detail_pembayaran.index"),
        ];
        Notification::create([
            "user_id" => $user->id,
            "pesan" => "Pembayaran berhasil diupload, silahkan tunggu konfirmasi dari admin",
            "title" => "Pembayaran",
        ]);
        echo json_encode($response);
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
        $checkout->qty = $request->qty;
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
        $bank = Bank::all();
        $checkout = checkout::where("customer_id", $user->id)
            ->where("id", $id_transaksi)
            ->where("status", "Belum Dibayar")
            ->where("expired_at", ">=", date("Y-m-d H:i:s", strtotime("now")))
            ->first();
        if (!$checkout || strtolower($checkout->status) != "belum dibayar") {
            abort(404);
        }
        $adminSetting = AdminSetting::latest()->get();
        return view('pembayaran', ["title" => "Pembayaran", 'bank' => $bank, "checkout" => $checkout, "subtitle" => "Pembayaran", "user" => $user, "setting" => $adminSetting[0]]);
    }
}
