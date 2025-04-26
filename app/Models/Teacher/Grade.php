<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = [
        "course_id",
        "year",
        "student_id",
        "semester",
        "assignment",
        "project",
        "exams",
        "attendance_presence",
    ];
}
