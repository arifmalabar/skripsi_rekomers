<?php

namespace App\Models\Headmaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory;
    public $incrementing = false;
    public $primaryKey = "id";
    public $fillable = [
        "id", "name"
    ];
    public $timestamps = false;
}
