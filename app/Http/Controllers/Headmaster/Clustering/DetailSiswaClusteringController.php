<?php

namespace App\Http\Controllers\Headmaster\Clustering;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Headmaster\BaseHeadmasterController;
use App\Http\Controllers\Headmaster\Student\StudentController;
use App\Models\Clustering;
use App\Models\Headmaster\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DetailSiswaClusteringController extends BaseHeadmasterController
{
    private StudentController $student;
    function __construct() {
        $this->model = new Clustering();
        $this->student = new StudentController();
    }
    public function index($id)
    {
        Session::put("student_id", $id);
        return view("headmaster/clustering_siswa/clustering_siswa", ["nama" => "clustering"]);
    }
    public function getData()
    {
        try {
            return ["data_siswa" => $this->dataSiswa(), "hasil_cluster" => $this->getHasilClusterSiswa()];
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }
    }
    public function dataSiswa()
    {
        return $this->student->model->where("id", "=", Session::get("student_id"))->first();
    }
    public function getHasilClusterSiswa()
    {
        return $this->model->selectRaw("
                                (SELECT course_name FROM courses WHERE courses.id = clusterings.course_id) as course_name,
                                year, semester, cluster, risk, student_id")
                                ->where("student_id", "=", Session::get("student_id"))
                                ->get();
    }
    
}
