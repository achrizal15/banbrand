<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\checkout;
use App\Models\Notification;
use App\Models\SellerLogBookSaldo;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = new checkout();
        $transaksi = $transaksi->where("status", "Dibayar")->get();
        return view("das.admin.tr_verif_pembayaran.index", [
            "title" => "Verifikasi Pembayaran",
            "transaksi" => $transaksi
        ]);
    }
    public function verifikasi(Request $request, checkout $transaksi)
    {
        $status = $request->status;
        $kasSeller = SellerLogBookSaldo::where("seller_id", $transaksi->seller_id)->orderBy('id', 'DESC')->first();
        if ($status == "terima") {
            $transaksi->status = "Proses";
            $transaksi->expired_at = now()->addDays(7);
            $transaksi->save();
            Notification::create([
                "title" => "Bukti diterima",
                "pesan" => "Transaksi dengan nomor " . $transaksi->no_transaksi . " telah diproses",
                "user_id" => $transaksi->customer_id
            ]);
            SellerLogBookSaldo::create([
                "seller_id" => $transaksi->seller_id,
                "saldo" => $kasSeller->saldo + $transaksi->harga,
                "keterangan" => "Penjualan " . $transaksi->produk->nama . " dengan nomor transaksi " . $transaksi->no_transaksi,
                "jumlah" => $transaksi->harga,
                "jenis" => "debit"
            ]);
            return redirect()->route("admin.transaksi")->with("success", "Transaksi Berhasil Proses");
        } else {
            Notification::create([
                "title" => "Bukti pembayaran di tolak",
                "pesan" => "Transaksi dengan nomor " . $transaksi->no_transaksi . " telah ditolak",
                "user_id" => $transaksi->customer_id
            ]);
            $transaksi->delete();
            return redirect()->route("admin.transaksi")->with("success", "Transaksi Berhasil Dibatalkan");
        }
    }
    public function ordering()
    {
        $transaksi = checkout::latest()->with(["produk", "seller", "customer"])->get();
        return view("das.admin.tr_ordering.index", [
            "title" => "Verifikasi Pembayaran",
            "transaksi" => $transaksi
        ]);
    }
}
