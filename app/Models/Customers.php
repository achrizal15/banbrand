<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public function useractivitylog()
    {
        return $this->hasMany(Useractivitylog::class, "user_id", "id");
    }
}
