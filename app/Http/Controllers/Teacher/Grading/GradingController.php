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
            //$kelas = Course::where("id", "=", $data["id_mapel"])->first();
            $result = DB::select("
            SELECT 
                courses.id as course_id,
                courses.year as year,
                students.id as students_id,
                courses.semester_id as semester
            FROM students
            JOIN 
                classrooms 
            ON 
                classrooms.id = students.classroom_id
            JOIN
                courses
            ON
                courses.classroom_id = classrooms.id
            WHERE 
                courses.id = '".$data["id_mapel"]."' AND -- ini dari form
                courses.year = ".$data["tahun"]." AND -- ini dari form
                courses.semester_id = '".$data["semester"]."' -- ini dari form 
            EXCEPT 
            select 
                grades.course_id,
                grades.year,
                grades.student_id,
                grades.semester
            FROM 
                grades
        ");
        
            return $result;
        } catch (QueryException $th) {
            throw new QueryException($th->getMessage());
        }
    }
    public function insertData(Request $request)
    {
        try {
            $data = $this->getUngradedStudent($request->all());
            $ready_toinsert = [];
            foreach ($data as $key) {
                $item_data = [
                    "course_id" => $key->course_id,
                    "year" => $key->year,
                    "semester" => $key->semester,
                    "student_id" => $key->students_id,
                    "assignment" => 0.0,
                    "project" => 0.0,
                    "exams" => 0.0,
                    "attendance_presence" => 0.0
                ];
                array_push($ready_toinsert, $item_data);
            }
            $this->model->insert($ready_toinsert);
            //insert data
            return response()->json(["status" => "success"], 200);
        } catch (QueryException $th) {
            return $this->showError($th->getMessage());
        }
    }
}
