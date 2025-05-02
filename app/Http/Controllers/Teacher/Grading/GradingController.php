<?php

namespace App\Http\Controllers\Teacher\Grading;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Teacher\BaseTeacherController;
use App\Models\Headmaster\Classroom;
use App\Models\Headmaster\Course;
use App\Models\Teacher\Grade;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                (SELECT courses.classroom_id FROM courses WHERE courses.id = grades.course_id) as id_kelas,
               grades.course_id as id_mapel,
                (SELECT course_name FROM courses WHERE courses.id = grades.course_id) AS nama_mapel,
                grades.year as tahun,
                (SELECT academic_year FROM years WHERE years.year = grades.year) as tahun_ajar,
                semester
            ")->groupByRaw("id_kelas, course_id, year, semester")->get();
        } catch (QueryException $th) {
            return $this->showError($th->getMessage());
        }
    }
    public function showNilai(Request $request)
    {
        return response()->json($request->all(), 200);
    }
    private function getUngradedStudent($data)
    {
        try {
            $kelas = Course::where("id", "=", $data["id_mapel"])->first();
            $result = DB::select("
                SELECT 
                    courses.id as course_id,
                    years.year as year,
                    students.id as student_id,
                    semesters.semester as semester
                FROM 
                    courses, years, students, semesters
                WHERE 
                    students.classroom_id = '".$kelas->classroom_id."'
                EXCEPT
                SELECT 
                    grades.course_id,
                    grades.year,
                    grades.student_id,
                    grades.semester
                FROM 
                    grades
                WHERE 
                    grades.course_id = '".$data["id_mapel"]."' AND 
                    grades.year = ".$data["tahun"]." AND 
                    grades.semester = '".$data["semester"]."'
        ");
        /*$result = DB::select("
                SELECT 
                    courses.id as course_id,
                    years.year as year,
                    students.id as student_id,
                    semesters.semester as semester
                FROM 
                    courses, years, students, semesters
                WHERE 
                    students.classroom_id = 'K001'
                EXCEPT
                select 
                    grades.course_id,
                    grades.year,
                    grades.student_id,
                    grades.semester
                FROM 
                    grades
                WHERE 
                    grades.course_id = 'C001' AND 
                    grades.year = 2025 AND 
                    grades.semester = 'GANJIL'
        ");*/
            return $result;
        } catch (QueryException $th) {
            throw new QueryException($th->getMessage());
        }
    }
    public function insertData(Request $request)
    {
        $data = $this->getUngradedStudent($request->all());
        //insert data
        return $data;
    }
}
