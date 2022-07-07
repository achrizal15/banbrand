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
        if ($request->status == "selesai") {
            $permintaan->status = "selesai";
            $permintaan->save();
            Notification::create([
                "user_id" => $permintaan->customer_id,
                "pesan" => "Pesanan anda telah selesai",
                "title" => "Pesanan Selesai",
            ]);
        } else {
            $permintaan->status = "Batal";
            $permintaan->save();
            Refund::create([
                "checkout_id" => $permintaan->id,
                "no_rekening" => $permintaan->no_rekening,
                "keterangan" => "Pembatalan pesanan",
                "saldo" => $permintaan->harga * $permintaan->qty, "type" => "refund"
            ]);
            Notification::create([
                "user_id" => $permintaan->customer_id,
                "pesan" => "Pesanan anda ditolak pesanan anda telah dibatalkan oleh penjual, uang anda akan dikembalikan ke rekening anda",
                "title" => "Pesanan Ditolak",
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
        $permintaan = $permintaan->latest()
            ->where("seller_id", auth()->guard("sellers")->user()->id);
        $permintaan = $permintaan->with(["produk", "customer", "price_product", "galery"])
            ->get();
        return view("das.seller.ordering.index", ["title" => "ordering", "permintaan" => $permintaan]);
    }
    public function penarikan()
    {
        $penarikan = new Refund();
        $penarikan = $penarikan->where("seller_id", auth()->guard("sellers")->user()->id);
        $penarikan = $penarikan->with(["seller.bank"])->get();
        $lastKas = SellerLogBookSaldo::where("seller_id", auth()->guard("sellers")->user()->id)->orderBy('id', 'DESC')->first();
        $kas = SellerLogBookSaldo::where("seller_id", auth()->guard("sellers")->user()->id)->orderBy('id', 'DESC')->get();
        if (!$lastKas) {
            return abort(404);
        }
        return view("das.seller.penarikan.index", ["title" => "Penarikan & Kas", "penarikan" => $penarikan, "lastKas" => $lastKas, "kas" => $kas]);
    }
    public function penarikanPost(Request $request)
    {
        $request->validate([
            "saldo" => "required|min:50000|numeric",
            "keterangan" => "required",
        ]);
        Refund::create([
            "seller_id" => auth()->guard("sellers")->user()->id,
            "saldo" => $request->saldo,
            "keterangan" => $request->keterangan,
            "type" => "penarikan",
            "no_rekening" => auth()->guard("sellers")->user()->no_rekening
        ]);
        $response = [
            "message" => "Berhasil",
            "url" => route("sellers.penarikan", ["product" => $request->produk_id])
        ];
        echo json_encode($response);
    }
}
