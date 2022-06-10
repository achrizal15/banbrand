<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SellerLogBookSaldo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected String $title = "Dashboard";

    public function index()
    {
        return view('das.admin.index', ["title" => $this->title]);
    }
    public function kas()
    {

        $request = Request();
        $defaultStartDate = date("Y-m-d", strtotime("-1 month"));
        $defaultEndDate = date("Y-m-d", strtotime("+1 day"));
        $startdate = $request->startdate ? date("Y-m-d",strtotime($request->startdate)) : $defaultStartDate;
        $enddate = $request->enddate ? date("Y-m-d",strtotime($request->enddate)) : $defaultEndDate;
        $kas = SellerLogBookSaldo::where("created_at",">",$startdate)->where("created_at","<",$enddate)->latest()->get();
        $jumlahDebit = $kas->filter(function ($item) {
            return $item->jenis == "debit";
        })->sum("jumlah");
        $jumlahKredit = $kas->filter(function ($item) {
            return $item->jenis == "kredit";
        })->sum("jumlah");

        return view('das.admin.kas.index', [
            "title" => "Kas",
            "kas" => $kas,
            "jumlahDebit" =>  $jumlahDebit,
            "jumlahKredit" => $jumlahKredit,
            "startdate" => $startdate,
            "enddate" => $enddate
        ]);
    }
}
