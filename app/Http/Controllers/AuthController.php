<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Customers;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Seller;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $ROLE = ["admin", "sellers", "customer"];
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
            if (auth("sellers")->check()) return redirect("/sellers");
            return view("auth.sellers.login", ["title" => "Login Seller", "kategori" => $this->kategori, "subtitle" => "Login Seller", "url" => Route("loginAuth", $params), 'type' => 'seller']);
        }
        if ($params == "admin") {
            if (auth("admin")->check()) return redirect("/admin");
            return view("auth.sellers.login", ["title" => "Login Admin", "kategori" => $this->kategori, "subtitle" => "Login Admin", "url" => Route("loginAuth", $params), 'type' => 'admin']);
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
    private function __create_customer()
    {
        $request = Request();
        $request->validate([
            "email" => "unique:customers,email"
        ]);
        $customer = new Customers();
        $customer->nama = $request->nama;
        $customer->email = $request->email;
        $customer->alamat = $request->alamat;
        $customer->phone = $request->phone;
        $customer->password = Hash::make($request->password);
        $customer->save();
        $response = [
            "message" => "Akun berhasil dibuat, dan login sebagai customer",
            "url" => "",
        ];
        return $response;
    }
    public function auth(Request $request, $params)
    {
        $params = strtolower($params);
        if (!in_array($params, $this->ROLE)) {
            abort("404");
        }
        $validate = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        $response = "";
        if ($params == "sellers") {
            $response = $this->__authSeller($validate);
            if ($response == "error") {
                return response()->json(["errors" => ["message" => ["Login failed"]]], 422);
            }
        }
        if ($params == "admin") {
            $response = $this->__authAdmin($validate);
            if ($response == "error") {
                return response()->json(["errors" => ["message" => ["Login failed"]]], 422);
            }
        }
        if ($params == "customer") {
            $response = $this->__authCustomer($validate);
            if ($response == "error") {
                return response()->json(["errors" => ["message" => ["Login failed"]]], 422);
            }
        }
        echo json_encode($response);
    }
    private function __authAdmin($data)
    {
        $request = Request();
        $user = User::where("email", $request->email)->first();
        if ($user) {
            if (Auth::guard("admin")->attempt($data)) {
                $request->session()->regenerate();
                $response = [
                    "message" => "Berhasil login.",
                    "url" => route("admin"),
                ];
                return $response;
            }
        }
        return "error";
    }
    private function __authCustomer($validate)
    {
        $request = Request();
        $user = Customers::where("email", $request->email)->first();
        if ($user) {
            if (Auth::guard("customers")->attempt($validate)) {
                $request->session()->regenerate();
                $response = [
                    "message" => "Login berhasil",
                    "url" => '',
                ];
                return $response;
            }
        }
        return "error";
    }
    private function __authSeller($validate)
    {
        $request = Request();
        $user = Seller::where("email", $request->email)->first();
        if ($user) {
            if (Auth::guard("sellers")->attempt($validate)) {
                $request->session()->regenerate();
                $response = [
                    "message" => "Berhasil login.",
                    "url" => route("sellers"),
                ];
                return $response;
            }
        }
        return "error";
    }
    public function logOut($guard)
    {
        Auth::logout();
        Auth::guard($guard)->logout();
        return redirect("/");
    }
    public function create($params)
    {
        $params = strtolower($params);
        if (!in_array($params, $this->ROLE)) {
            abort("404");
        }
        $response = [];
        if ($params == "sellers") {
            $response = $this->__create_seller();
        }
        if ($params == "customer") {
            $response = $this->__create_customer();
        }
        echo json_encode($response);
    }


    private function __create_seller()
    {
        request()->validate([
            "username" => "required|unique:sellers,username",
            "nama-toko" => "required|unique:sellers,nama_toko",
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
        $sellers = new Seller;
        $sellers->nama = request()->input("nama-penjual");
        $sellers->username = request()->username;
        $sellers->email = request()->email;
        $sellers->password = Hash::make(request()->password);
        $sellers->nama_toko = request()->input("nama-toko");
        $sellers->logo = $logo;
        $sellers->alamat = request()->input("alamat-penjual");
        $sellers->kota = $kota;
        $sellers->kecamatan = $kecamatan;
        $sellers->kelurahan = $kelurahan;
        $sellers->kode_pos = request()->input("kode-pos");
        $sellers->alamat_toko = request()->input("alamat_toko");
        $sellers->no_telp = request()->input("no-handphone");
        $sellers->no_telp_toko = request()->input("no-toko");
        $sellers->no_rekening = request()->input("no-rekening");
        $sellers->bank_id = request()->bank;
        $sellers->save();

        $response = [
            "message" => "Akun berhasil dibuat.",
            "url" => route("login", "sellers"),
        ];
        return $response;
    }
}
