<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SellerLogBookSaldo;
use App\Models\Useractivitylog;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //constructor

    public function index()
    {
        $condition = request()->condition;
        $sellers = Seller::latest();
        if ($condition == "approval") {
            $sellers = $sellers->where("is_active", 0);
        } else {
            $sellers = $sellers->where("is_active", 1);
        }

        return view("das.admin.sellers.index", ["title" => "Sellers", "sellers" => $sellers->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("das.admin.sellers.show", ["title" => "Seller", "seller" => Seller::findOrFail($id)->load(["tags", "useractivitylog"])]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller)
    {
        if (isset($request->approval)) {
            if ($request->approval == "active") {
                $seller->is_active = 1;
                Useractivitylog::create([
                    "user_id" => $seller->id,
                    "activity" => "Actived",
                    "details" => "Aktivasi akun telah disetujui oleh admin.",
                    "ip" => request()->ip(),
                    "icon" =>"fa-solid fa-check",
                    "bg_color" => "bg-info"
                ]);
                SellerLogBookSaldo::create([
                    "seller_id" => $seller->id,
                    "saldo" => 0,
                    "keterangan" => "Aktivasi akun",
                    "jumlah" => 0,
                    "jenis" => "debit"
                ]);
                echo json_encode($seller->saveOrFail());
            } else {
                echo json_encode($seller->deleteOrFail());
            }
            return;
        }
    }
    public function password_reset(Request $request, Seller $seller)
    {
        $seller->password = Hash::make($request->password);
        $seller->saveOrFail();
        $response = [
            "message" => "Seller $seller->nama Reset Password Successfully",
            "url" => route("admin.sellers.show",$seller->id)
        ];
        Useractivitylog::create([
            "user_id" => $seller->id,
            "activity" => "Reset password",
            "details" => $response["message"],
            "ip" => request()->ip(),
            "icon" =>"fa-solid fa-key-skeleton",
            "bg_color" => "bg-primary"
        ]);
        echo json_encode($response);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        $seller->is_ban = request()->input("is_ban");
        $seller->saveOrFail();
        $message = $seller->is_ban == 1 ? "Banned " : "Unbanned ";
        $response = [
            "message" => "Seller $seller->nama $message Successfully",
            "url" => route("admin.sellers.index")
        ];
        Useractivitylog::create([
            "user_id" => $seller->id,
            "activity" => $message,
            "details" => $response["message"],
            "ip" => request()->ip(),
            "icon" => request("is_ban") == 1 ? "fa-solid fa-shield-slash" : "fa-solid fa-shield-check",
            "bg_color" => request("is_ban") == 1 ? "bg-danger" : "bg-warning"
        ]);
        echo json_encode($response);
    }
}
