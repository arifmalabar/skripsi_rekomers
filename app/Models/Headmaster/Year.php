<?php

namespace App\Models\Headmaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;
    public $primaryKey = "year";
    public $fillable = ["year", "academic_year"];
    public $incrementing = false;
    public $timestamps = false;
}
