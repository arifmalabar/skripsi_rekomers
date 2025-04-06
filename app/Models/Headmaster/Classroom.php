<?php

namespace App\Models\Headmaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    public $primaryKey = "id";
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = [
        "id", "program_study_id", "classname"
    ];
}
