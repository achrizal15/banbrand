<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\checkout;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        abort(404);
    }
    public function store(Request $request)
    {
        echo json_encode($request->all());
    }
}
