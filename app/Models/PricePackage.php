<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricePackage extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public function produkgaleries()
    {
        return $this->hasMany(ProductGalery::class, "entity_id");
    }
    public function produk()
    {
        return $this->belongsTo(Product::class, "product_id");
    }
}
