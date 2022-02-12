<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('das.admin.index',["title"=>$this->title]);
    }
}
