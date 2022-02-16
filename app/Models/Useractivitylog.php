<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Client\Request;

class Useractivitylog extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    //relationships belongsTo user
    public function user()
    {
        return $this->belongsTo(User::class, "id", "user_id");
    }
    //relationships belongsTo customers
    public function customer()
    {
        return $this->belongsTo(Customer::class, "id", "user_id");
    }
    //relationships belongsTo seller
    public function seller()
    {
        return $this->belongsTo(Seller::class, "id", "user_id");
    }
}
