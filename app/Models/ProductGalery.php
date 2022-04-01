<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGalery extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public function priceproduk()
    {
        return $this->belongsTo(PricePackage::class);
    }
}
