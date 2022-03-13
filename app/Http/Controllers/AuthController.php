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
            request()->validate([
                "username" => "required|unique:sellers,username",
                "email" => "required|email|unique:sellers",
                "password" => "required|min:3",
            ]);
            $logo = "default.jpg";
            if (request()->hasFile('logo')) {
                request()->file("logo")->store("public/logo-sellers");
                $logo = request()->file("logo")->hashName();
            }
            $kota = explode("|", request()->kota)[0];
            $kecamatan = explode("|", request()->kecamatan)[0];
            $kelurahan = explode("|", request()->kelurahan)[0];
            $sellers=new Seller;
            $sellers->nama = request()->input("nama-penjual");
            $sellers->username = request()->username;
            $sellers->email = request()->email;
            $sellers->password = Hash::make(request()->password);
            $sellers->nama_toko=request()->input("nama-toko");
            $sellers->logo = $logo;
            $sellers->alamat = request()->input("alamat-penjual");
            $sellers->kota = $kota;
            $sellers->kecamatan = $kecamatan;
            $sellers->kelurahan = $kelurahan;
            $sellers->kode_pos=request()->input("kode-pos");
            $sellers->alamat_toko=request()->input("alamat_toko");
            $sellers->no_telp = request()->input("no-handphone");
            $sellers->no_telp_toko =request()->input("no-toko");
            $sellers->no_rekening =request()->input("no-rekening");
            $sellers->bank_id= request()->bank;
            $sellers->save();
         
            $response = [
                "message" => "Akun berhasil dibuat.",
                "url" => route("login", "sellers"),
            ];
        }
        echo json_encode($response);
    }
    // private function create_sellers()
    // {
    
    //     return $response;
    // }
}
