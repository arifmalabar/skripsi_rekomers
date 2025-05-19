<?php

namespace App\Http\Controllers\Headmaster\Dashboard;

use App\Http\Controllers\Clustering\ClusteringController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Headmaster\BaseHeadmasterController;
use App\Http\Controllers\Headmaster\ProgramStudy\ProgramStudyController;
use App\Http\Controllers\Headmaster\Student\StudentController;
use App\Http\Controllers\Headmaster\Teacher\TeacherController;
use App\Models\Headmaster\ProgramStudy;
use Illuminate\Http\Request;

class DashboardController extends BaseHeadmasterController
{
    private TeacherController $teacher;
    private StudentController $student;
    private ProgramStudyController $programstudy;
    private ClusteringController $clustering;
    public function __construct() {
        $this->teacher = new TeacherController();
        $this->student = new StudentController();
        $this->programstudy = new ProgramStudyController();
        $this->clustering  = new ClusteringController();
    }
    public function index()
    {
        return view("headmaster/dashboard/dashboard", ["nama" => "dashboard"]);
    }
    public function getData()
    {
        try {
            $data = [
                "jml_siswa" => $this->student->model->count(),
                "jumlah_jurusan" => $this->programstudy->getData()->count(),
                "jumlah_guru" => $this->teacher->getData()->count(),
                "presentase" => $this->hitungPresentase()
            ];
            return response()->json($data);
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }
    }
    private function hitungPresentase()
    {
        $high = $this->getCount("C1")->count();
        $mid = $this->getCount("C2")->count();
        $low = $this->getCount("C3")->count();
        
        $total = $high + $mid + $low;
        try {
            return [
                "risiko_tinggi" => round(($high / $total) * 100, 0),
                "risiko_tengah" => round(($mid / $total) * 100, 0),
                "risiko_rendah" => round(($low / $total) * 100, 0)
            ];
        } catch (\Throwable $th) {
            return [
                "risiko_tinggi" => 0,
                "risiko_tengah" => 0,
                "risiko_rendah" => 0
            ];
        }
    }   
    private function getCount($criteria)
    {
        return $this->clustering->model->where("cluster", "=", $criteria);
    } 
}
