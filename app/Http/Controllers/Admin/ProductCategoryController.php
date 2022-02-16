<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categorys = ProductCategory::latest()->get();
        return view("das.admin.category.index", ["title" => "Category", "categorys" => $categorys]);
    }
    public function create()
    {
        return view("das.admin.category.form", ["title" => "Form Category", "url" => route('admin.categorys.store')]);
    }
    public function edit(ProductCategory $category)
    {
        return view("das.admin.category.form", [
            "title" => "Form Category",
            "url" => route('admin.categorys.update', $category->id),
            "category" => $category
        ]);
    }
    public function update(Request $request, ProductCategory $category)
    {
        $rule = ['deskripsi' => 'required'];
        if ($request->nama != $category->nama) {
            $rule['nama'] = 'required|unique:product_categories';
        }
     $this->validate($request, $rule);
     $category->nama = $request->nama;
     $category->deskripsi = $request->deskripsi;
     $category->status = $request->status ? $request->status : "off";
     $category->save();
        $response = [
            "message" => "Category $category->nama Updated Successfully",
            "url" => route("admin.categorys.index")
        ];
        echo json_encode($response);
    }
    public function destroy(ProductCategory $category)
    {
        $response = [
            "message" => "Category $category->nama Deleted Successfully",
            "url" => route("admin.categorys.index")
        ];
        $category->deleteOrFail();
        echo json_encode($response);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|unique:product_categories,nama',
            'deskripsi' => 'required',
        ]);
        $category = new ProductCategory;
        $category->nama = $request->nama;
        $category->deskripsi = $request->deskripsi;
        $category->status = $request->status ? $request->status : "off";
        $category->save();
        $response = [
            "message" => "Seller $request->nama Successfully",
            "url" => route("admin.categorys.index")
        ];
        echo json_encode($response);
    }
}
