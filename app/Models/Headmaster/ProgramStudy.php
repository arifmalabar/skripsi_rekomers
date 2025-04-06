<?php

namespace App\Models\Headmaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudy extends Model
{
    use HasFactory;
    public $fillable = ["id", "program_study_name"];
    public $incrementing = false;
    public $primaryKey = "id";
    public $timestamps = false;
}
