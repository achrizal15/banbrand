<?php

namespace App\Http\Controllers;

use App\Models\AdminSetting;
use App\Models\checkout;
use App\Models\Notification;
use Illuminate\Http\Request;

class DetailPembayaranController extends Controller
{
    public function index()
    {
        $user = auth()->guard("customers")->user();
        if (!$user) {
         abort(404);
        }
        $pesanan = new checkout();
        $pesanan = $pesanan->orderBy("id", "desc")->where("customer_id", $user->id)->get();
        $notif = new Notification();
        $notif = $notif->where("user_id", $user->id)->get();
        $adminSetting=AdminSetting::latest()->get();
        return view("detail_pembayaran", ["title" => "Detail Pembayaran","notif"=>$notif, "user" => $user, 'pesanan' => $pesanan, "subtitle" => "Detail Pembayaran"]);
    }
    public function notifikasi(){
        $user = auth()->guard("customers")->user();
        if (!$user) {
         abort(404);
        }
        $notif = new Notification();
        $notif = $notif->where("user_id", $user->id)->latest()->get();
        return view("notifikasi", ["title" => "Notif","notif"=>$notif, "user" => $user, "subtitle" => "Notifikasi"]);
    }
    public function dibaca(Request $request,Notification $notifikasi){
        $user = auth()->guard("customers")->user();
        if (!$user) {
         abort(404);
        }
        $notifikasi->update(["dibaca"=>1]);
        return redirect()->back();
    }
    public function delete_notifikasi(Notification $notifikasi){
        $user = auth()->guard("customers")->user();
        if (!$user) {
         abort(404);
        }
        $notifikasi->delete();
        return redirect()->back();
    }
    public function batal_pesanan(checkout $checkout)
    {
        $checkout->update(["status" => "Batal"]);
        return   redirect()->route("detail_pembayaran.index");
    }
}
