<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Customers extends Authenticatable
{
    use HasFactory;
    protected $guarded = ["id"];
    protected $hidden = [
        'password'
    ];
    public function useractivitylog()
    {
        return $this->hasMany(Useractivitylog::class, "user_id", "id");
    }
}
