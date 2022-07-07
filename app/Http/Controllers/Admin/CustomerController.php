<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\checkout;
use App\Models\Customers;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customers::latest()->where('is_ban', '!=', '1')->get();
        return view("das.admin.customer.index", ["title" => "Customer", "customer" => $customer]);
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
    public function show(Customers $customer)
    {

        return view("das.admin.customer.show", ["title" => "Customer", "customer" => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = auth()->guard("customers")->user();
        if (!$user) {
            abort(404);
        }
        $notif = new Notification();
        $notif = $notif->where("user_id", $user->id)->get();
        return view("profil", ["title" => "Profil", "notif" => $notif, "user" => $user, "subtitle" => "Profil"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customers $customer)
    {
        $customer->nama = $request->nama;
        $customer->alamat = $request->alamat;
        $customer->phone = $request->phone;
        if ($request->password != "") {
            $customer->password = Hash::make($request->password);
        }
        $customer->save();
        $response = [
            "message" => "Customer $customer->nama updated Successfully",
            "url" => route("customer.edit")
        ];
        echo json_encode($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customers $customer)
    {
        $response = [
            "message" => "Customer $customer->nama Deleted Successfully",
            "url" => route("admin.customers.index")
        ];
        $customer->is_ban = 1;
        $customer->ban_at = date('Y-m-d');
        $customer->saveOrFail();
        echo json_encode($response);
    }
}
