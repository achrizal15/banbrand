<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
    public function kategori()
    {
        return $this->hasOne(ProductCategory::class, "id", "category_id");
    }
    public function priceproduk()
    {
        return $this->hasMany(PricePackage::class, "produk_id", "id");
    }
    public function checkout()
    {
        return $this->hasMany(checkout::class, "produk_id", 'id');
    }
}
