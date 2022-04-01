<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    //relationships hasmany Useractivitylog
    public function useractivitylog()
    {
        return $this->hasMany(Useractivitylog::class, "user_id", "id");
    }
    public function bank()
    {
        return $this->hasOne(Bank::class, "bank_id");
    }
    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
