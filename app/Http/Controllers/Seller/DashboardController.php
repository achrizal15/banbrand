<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\checkout;
use App\Models\Notification;
use App\Models\Refund;
use App\Models\SellerLogBookSaldo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $title = "Dashboard";
        return view("das.seller.index", ["title" => $title]);
    }
    public function permintaan()
    {
        $permintaan = new checkout();
        $permintaan = $permintaan->where("seller_id", auth()->guard("sellers")->user()->id);
        $permintaan = $permintaan->with(["produk", "customer", "price_product", "galery"])
            ->where("status", "Proses")
            ->get();
        return view("das.seller.permintaan.index", ["title" => "Permintaan", "permintaan" => $permintaan]);
    }
    public function permintaanAction(Request $request, checkout $permintaan)
    {
        if (strtolower($permintaan->status) == "selesai") {
            return abort(404);
        }
        $kasSeller = SellerLogBookSaldo::where("seller_id", $permintaan->seller_id)->orderBy('id', 'DESC')->first();
        if ($request->status == "selesai") {
            $permintaan->status = "selesai";
            $permintaan->save();
            Notification::create([
                "user_id" => $permintaan->customer_id,
                "pesan" => "Pesanan anda telah selesai",
                "title" => "Pesanan Selesai",
            ]);
        } else {
            $permintaan->status = "expired";
            $permintaan->save();
            Refund::create([
                "checkout_id" => $permintaan->id,
                "no_rekening" => $permintaan->no_rekening,
            ]);
            Notification::create([
                "user_id" => $permintaan->customer_id,
                "pesan" => "Pesanan anda ditolak pesanan anda telah dibatalkan oleh penjual uang anda akan dikembalikan ke rekening anda",
                "title" => "Pesanan Ditolak",
            ]);
            SellerLogBookSaldo::create([
                "seller_id" => $permintaan->seller_id,
                "jumlah" => $permintaan->harga,
                "jenis" => "kredit",
                "keterangan" => "Pembatalan pesanan dengan nomor transaksi " . $permintaan->no_transaksi,
                "saldo" => $kasSeller->saldo - $permintaan->harga,
            ]);
        }
        $response = [
            "message" => "Proses diperbarui",
            "url" => route("sellers.permintaan")
        ];
        echo json_encode($response);
    }
    public function ordering()
    {
        $permintaan = new checkout();
        $permintaan = $permintaan->where("seller_id", auth()->guard("sellers")->user()->id);
        $permintaan = $permintaan->with(["produk", "customer", "price_product", "galery"])
            ->get();
        return view("das.seller.ordering.index", ["title" => "ordering", "permintaan" => $permintaan]);
    }
}
