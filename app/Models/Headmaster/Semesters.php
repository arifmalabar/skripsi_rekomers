<?php

namespace App\Models\Headmaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semesters extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $timestamps = false;
    public $primaryKey = "semester";
    public $fillable = ["semester"];
}
