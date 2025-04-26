<?php

namespace App\Http\Controllers\Teacher\Grading;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Teacher\BaseTeacherController;
use App\Models\Teacher\Grade;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;

class GradingController extends BaseTeacherController
{
    
    public function __construct() {
        $this->model = new Grade();
    }
    public function index()
    {
        return view($this->path."penilaian/penilaian", ["nama" => "penilaian"]);
    }
    public function getData()
    {
        try {
            return $this->model->selectRaw("
                (SELECT course_name FROM courses WHERE courses.id = grades.course_id) AS nama_mapel,
                (SELECT academic_year FROM years WHERE years.year = grades.year) as tahun,
                (SELECT name FROM students WHERE students.id = grades.student_id) as nama_siswa,
                semester,
                assignment,
                project,
                exams,
                attendance_presence
            ")->get();
        } catch (QueryException $th) {
            return $this->showError($th->getMessage());
        }
    }
}
