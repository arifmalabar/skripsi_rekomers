<?php

namespace App\Models\Headmaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public $primaryKey = "id";
    public $fillable = ["id", "classroom_id", "name", "gender"];
    public $incrementing = false;
    public $timestamps = false;
}
