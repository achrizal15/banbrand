<?php

namespace App\Http\Controllers;

use App\Models\AdminSetting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        $title = "Setting";
        $data = AdminSetting::first();
        return view("das.admin.setting.form", ["title" => $title, "url" => route("admin.setting.update", $data->id), "data" => $data]);
    }
    public function update(Request $request, AdminSetting $adminsetting)
    {
        $data = [
            'email' => $request->email,
            'nama_bank' => $request->nama_bank,
            'atas_nama_bank' => $request->atas_nama_bank,
            'no_handphone' => $request->no_handphone,
            'no_rekening' => $request->no_rekening,
            'harga_ongkir' => $request->harga_ongkir,
            'about_us_web' => $request->about_us_web
        ];
        $adminsetting->update($data);
        $response = [
            "message" => "Berhasil diupdate",
            "url" => route("admin.setting.index")
        ];
        echo json_encode($response);
    }
}
