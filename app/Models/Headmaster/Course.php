<?php

namespace App\Models\Headmaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    public $primaryKey = "id";
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = ["id", "teacher_id", "year", "classroom_id", "course_name", "semester_id"];
}
