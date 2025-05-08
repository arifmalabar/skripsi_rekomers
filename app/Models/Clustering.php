<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clustering extends Model
{
    use HasFactory;
    public $fillable = [
        "student_id",
        "course_id",
        "clustering_grade",
        "cluster", 
        "risk",
        "year",
        "semester",
        "assignment",
        "project",
        "exams",
        "centroid1",
        "centroid2",
        "centroid3"
    ];
    public $timestamps = false;
    public $incrementing = false;
}
