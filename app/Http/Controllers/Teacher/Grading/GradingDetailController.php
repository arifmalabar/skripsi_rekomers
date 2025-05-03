<?php

namespace App\Http\Controllers\Teacher\Grading;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Teacher\BaseTeacherController;
use App\Models\Teacher\Grade;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class GradingDetailController extends BaseTeacherController
{
    private $id_mapel, $tahun, $semester;
    public function __construct() {
        $this->model = new Grade();
    }
    public function index(Request $request)
    {
        $data = $request->except("_token");
        $this->setSession($data);
        return view("teacher.detail_nilai.detail_nilai", ["nama" => "penilaian"]);
    }
    private function setSession($data)
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
    private function getUngradedStudent($data)
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
}
