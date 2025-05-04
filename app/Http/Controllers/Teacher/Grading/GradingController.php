<?php

namespace App\Http\Controllers\Teacher\Grading;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Teacher\BaseTeacherController;
use App\Models\Headmaster\Classroom;
use App\Models\Headmaster\Course;
use App\Models\Teacher\Grade;
use Doctrine\DBAL\Query\QueryException;
use Exception;
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
                students.id as students_id
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
                courses.id = '".$data["id_mapel"]."' 
            EXCEPT 
            select 
                grades.course_id,
                grades.student_id
            FROM 
                grades
            WHERE 
                grades.course_id = '".$data["id_mapel"]."' AND 
                grades.semester = '".$data["semester"]."' AND
                grades.year = ".$data["tahun"]."
        ");
        
            return $result;
        } catch (QueryException $th) {
            throw new QueryException($th->getMessage());
        }
    }
    private function getReadyToInsert($request, $data) {
        $ready_toinsert = [];
        foreach ($data as $key) {
            $item_data = [
                "course_id" => $key->course_id,
                "year" => $request->get("tahun"),
                "semester" => $request->get("semester"),
                "student_id" => $key->students_id,
                "assignment" => 0.0,
                "project" => 0.0,
                "exams" => 0.0,
                "attendance_presence" => 0.0
            ];
            array_push($ready_toinsert, $item_data);
        }
        return $ready_toinsert;
    }
    public function insertData(Request $request)
    {
        try {
            $data = $this->getUngradedStudent($request->all());
            
            if(count($this->getReadyToInsert($request, $data)) != 0)
            {
                $this->model->insert($this->getReadyToInsert($request, $data));
            } else {
                throw new Exception("Gagal tambah nilai", 500);
            }
            //insert data
            return response()->json(["status" => "success"], 200);
        } catch (QueryException $th) {
            return $this->showError($th->getMessage());
        } catch (Exception $t){
            return $this->showError($t->getMessage());
        }
    }
    public function deleteNilai(Request $request)
    {
        try {
            $this->model->where("course_id", "=", $request["course_id"])
                        ->where("year", "=", $request["year"])
                        ->where("semester", "=", $request["semester"])
                        ->delete();
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }
        return response()->json($request->all());
    }
}
