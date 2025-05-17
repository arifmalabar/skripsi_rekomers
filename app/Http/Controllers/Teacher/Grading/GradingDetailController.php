<?php

namespace App\Http\Controllers\Teacher\Grading;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Headmaster\Course\CourseController;
use App\Http\Controllers\Headmaster\Student\StudentController;
use App\Http\Controllers\Teacher\BaseTeacherController;
use App\Models\Teacher\Grade;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class GradingDetailController extends BaseTeacherController
{
    private $id_mapel, $tahun, $semester;
    private StudentController $student;
    private CourseController $course;
    public function __construct() {
        $this->model = new Grade();
        $this->student = new StudentController();
        $this->course = new CourseController();
    }
    public function index(Request $request)
    {
        $data = $request->except("_token");
        $this->setSession($data);
        return view("teacher.detail_nilai.detail_nilai", ["nama" => "penilaian"]);
    }
    public function setSession($data)
    {
        foreach ($data as $key => $value) {
            Session::put($key, $value);
        }
        $this->id_mapel = Session::get("id_mapel");
        $this->tahun = Session::get("tahun");
        $this->semester = Session::get("semester");
    }
    public function getData()
    {
        try {
            return $this->model->selectRaw("(SELECT course_name FROM courses WHERE courses.id = grades.course_id) AS nama_mapel,
                (SELECT academic_year FROM years WHERE years.year = grades.year) as tahun,
                (SELECT id FROM students WHERE students.id = grades.student_id) as nisn,
                (SELECT name FROM students WHERE students.id = grades.student_id) as nama_siswa,
                semester,
                assignment,
                project,
                exams,
                attendance_presence")
                ->where("grades.course_id", "=", Session::get("id_mapel"))
                ->where("grades.year", "=", Session::get("tahun"))
                ->where("grades.semester", "=", Session::get("semester"))
                ->get();
        } catch (QueryException $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
    public function getUngradedStudent($data)
    {
        try {
            
            $result = DB::select("
            SELECT 
                courses.id as course_id,
                years.year as year,
                students.id as student_id,
                semesters.semester as semester
            FROM 
                courses, years, students, semesters
            WHERE 
                students.classroom_id = ?
            EXCEPT
            SELECT 
                grades.course_id,
                grades.year,
                grades.student_id,
                grades.semester
            FROM 
                grades
            WHERE 
                grades.course_id = ? AND 
                grades.year = ? AND 
                grades.semester = ?
        ", [Session::get("id_kelas"), Session::get("id_mapel"), Session::get("tahun"), Session::get("semester")]);
            return $result;
        } catch (QueryException $th) {
            throw new QueryException($th->getMessage());
        }
    }
    public function insertData(Request $request)
    {
        $data = $this->getUngradedStudent($request->all());
        return $data;
    }
    public function condition($key)
    {
        return $this->model->where("student_id", "=", $key['student_id'])
                            ->where("course_id", "=", Session::get("id_mapel"))
                            ->where("year", "=", Session::get("tahun"))
                            ->where("semester", "=", Session::get("semester"));
    }
    public function saveNilai(Request $request)
    {
        $data = $request->except("_token");
        try {
            $nilai = [];
            foreach ($data as $key) {
                $item = [
                    "assignment" => $key['assignment'],
                    "project" => $key['project'],
                    "exams" => $key['exams'],
                    "attendance_presence" => $key['attendance_presence']
                ];
                $this->availableData($key, $item);
            }
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }
    }
    public function availableData($key, $item)
    {
        $cek = $this->condition($key)->count();
        if($cek != 0){
            $this->onlyUpdateGrade($key, $item);
        } else {
            $this->insertNewGrade($key, $item);
        }
    }
    public function onlyUpdateGrade($key, $item)
    {
        return $this->condition($key)->update($item);
    }
    public function insertNewGrade($key, $item)
    {
        $mapel = $this->course->model->where("id", "=", Session::get("id_mapel"))->first();
        $id = str_replace(["/", "."], "", $key["student_id"]);
        $data_siswa = [
            "id" => $id,
            "classroom_id" => $mapel->classroom_id,
            "name" => strtoupper($key["name"]),
            "gender" => "pria"
        ];
        //insert data siswa jika data siswa belum ada
        $cek_siswa = $this->student->model->where("id", "=", $key["student_id"]);
        if($cek_siswa->count() == 0){
            $this->student->model->insert($data_siswa);
        } 
        //insert data nilai
        $item["course_id"] = Session::get("id_mapel");
        $item["student_id"] = $key["student_id"];
        $item["year"] = Session::get("tahun");
        $item["semester"] = Session::get("semester");
        return $this->model->insert($item);
    }
}

