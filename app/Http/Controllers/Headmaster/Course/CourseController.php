<?php

namespace App\Http\Controllers\Headmaster\Course;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Headmaster\Course;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CourseController extends BaseController
{
    public function __construct() {
        $this->model = new Course();
        $this->kode = "C";
    }
    public function index()
    {
        return view("headmaster/course/course", ["nama" => "course"]);
    }
    public function getData()
    {
        try {
            return $this->model->selectRaw("
                id,
                (SELECT semester FROM semesters WHERE semester = courses.semester_id) as semester,
                (SELECT name FROM teachers WHERE id = courses.teacher_id) as guru,
                (SELECT years.year FROM years WHERE years.year = courses.year) as tahun_ajar,
                (SELECT classname FROM classrooms WHERE id = courses.classroom_id) as kelas,
                course_name"
            )->get();
        } catch (QueryException $th) {
            return $this->showError($th->getMessage());
        }
    }
}
