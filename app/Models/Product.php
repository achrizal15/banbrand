<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public function seller()
    {
        return $this->hasOne(Seller::class, "id","seller_id");
    }
    public function kategori(){
        return $this->hasOne(ProductCategory::class,"id","category_id");
    }
}
