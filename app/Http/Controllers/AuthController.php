<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Seller;
use App\Models\Useractivitylog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Console;

class AuthController extends Controller
{
    private $ROLE = ["admin-bb", "sellers", "customer"];
    private $kategori = [];
    public function __construct()
    {
        $this->kategori = ProductCategory::orderBy("nama", "ASC")->get();
    }
    public function index($params)
    {
        $params = strtolower($params);
        if (!in_array($params, $this->ROLE)) {
            abort("404");
        }
        if ($params == "sellers") {
            return view("auth.sellers.login", ["title" => "Login Seller", "kategori" => $this->kategori, "subtitle" => "Login Seller"]);
        }
    }
    public function register($params)
    {
        $params = strtolower($params);
        if (!in_array($params, $this->ROLE)) {
            abort("404");
        }
        if ($params == "sellers") {
            $banks = Bank::orderBy("nama", "ASC")->get();
            return view("auth.sellers.register", ["title" => "Register Seller", "kategori" => $this->kategori, "subtitle" => "Register Seller", "banks" => $banks]);
        }
    }
    public function create($params)
    {
        $params = strtolower($params);
        if (!in_array($params, $this->ROLE)) {
            abort("404");
        }
        $response = [];
        if ($params == "sellers") {
            $response =   $this->create_sellers();
        }
        echo json_encode($response);
    }
    private function create_sellers()
    {
        request()->validate([
            "username" => "unique:users",
            "email" => "required|email|unique:sellers",
            "password" => "required|min:3",
        ]);
        $logo = "default.jpg";
        if (request()->hasFile('logo')) {
            request()->file("logo")->store("public/logo-sellers");
            $logo = request()->file("logo")->hashName();
        }
        $username = request()->username ? request()->username : request()->input("nama-penjual") . "-" . date("YmdHis");
        $kota = explode("|", request()->kota)[0];
        $kecamatan = explode("|", request()->kecamatan)[0];
        $kelurahan = explode("|", request()->kelurahan)[0];
        Seller::create([
            "nama" => request()->input("nama-penjual"),
            "email" => request()->input("email"),
            "nama_toko" => request()->input("nama-toko"),
            "kode_pos" => request()->input("kode-pos"),
            "username" => $username,
            "alamat_toko" => request()->input("alamat_toko"),
            "kota" => $kota,
            "kecamatan" => $kecamatan,
            "kelurahan" => $kelurahan,
            "password" => Hash::make(request()->input("password")),
            "alamat" => request()->input("alamat-penjual"),
            "no_telp_toko" => request()->input("no-toko"),
            "no_telp" => request()->input("no-handphone"),
            "no_rekening" => request()->input("no-rekening"),
            "bank_id" => request()->input("bank"),
            "logo" => $logo,
        ]);
        $response = [
            "message" => "Akun berhasil dibuat.",
            "url" => route("login", "sellers"),
        ];
        $seller = Seller::where("email", request()->email)->first();
        Useractivitylog::create([
            "user_id" => $seller->id,
            "activity" => "Reset password",
            "details" => $response["message"],
            "ip" => request()->ip(),
            "icon" => "fa-solid fa-user-plus",
            "bg_color" => "bg-primary"
        ]);
        return $response;
    }
}
