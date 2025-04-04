<?php

namespace App\Models\Headmaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $primaryKey = "id";
    public $fillable = [
        "id", "name"
    ];
    public $timestamps = false;
}
