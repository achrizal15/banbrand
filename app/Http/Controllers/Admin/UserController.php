<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::latest()->get();
        return view("das.admin.user.index", ["title" => "User", "user" => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("das.admin.user.form", ["title" => "Form user", "url" => route('admin.users.store')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'name' => 'required',
        ]);
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);
        $response = [
            "message" => "User Created Successfully",
            "url" => route("admin.users.index")
        ];
        echo json_encode($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view("das.admin.user.form", [
            "title" => "Form user",
            "url" => route('admin.users.update', $user->id),
            "user" => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $poke = ['name' => 'required', 'email' => "required"];
        if ($request->email != $user->email) {
            $poke['email'] = 'required|unique:users,email';
        }
        $request->validate($poke);
        $user->name = $request->name;
        if ($request->email != '') {
            $user->email = $request->email;
        }
        if ($request->password != '') {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        $response = [
            "message" => "Update Successfully",
            "url" => route("admin.users.index")
        ];
        echo json_encode($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $response = [
            "message" => "Deleted Successfully",
            "url" => route("admin.users.index")
        ];
        $user->deleteOrFail();
        echo json_encode($response);
    }
}
