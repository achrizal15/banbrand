<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checkout extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public function produk()
    {
        return $this->belongsTo(Product::class, "produk_id");
    }
    public function seller()
    {
        return $this->belongsTo(Seller::class, "seller_id");
    }
    public function customer()
    {
        return $this->belongsTo(Customers::class, "customer_id");
    }
    public function price_product()
    {
        return $this->belongsTo(PricePackage::class, "price_id");
    }
    public function galery()
    {
        return $this->belongsTo(ProductGalery::class, "galery_id");
    }
    public function bank(){
        return $this->belongsTo(Bank::class,"bank_id");
    }
}
