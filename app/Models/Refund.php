<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public function transaksi()
    {
        return $this->belongsTo(checkout::class, "checkout_id");
    }
    public function seller()
    {
        return $this->belongsTo(Seller::class, "seller_id");
    }
}
