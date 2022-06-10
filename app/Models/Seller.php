<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Seller extends Authenticatable
{
    use HasFactory;
    use \Illuminate\Auth\Authenticatable;
    protected $guarded = ["id"];
    protected $hidden = [
        'password'
    ];
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
        return $this->belongsTo(Bank::class, "bank_id");
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function checkout(){
        return $this->hasMany(checkout::class);
    }
}
