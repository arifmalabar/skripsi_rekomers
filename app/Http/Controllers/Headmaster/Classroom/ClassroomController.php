<?php

namespace App\Http\Controllers\Headmaster\Classroom;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Headmaster\BaseHeadmasterController;
use App\Models\Headmaster\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends BaseHeadmasterController
{
    function __construct() {
        $this->model = new Classroom();
        $this->kode = "K";
    }
    public function index()
    {
        return view($this->path."kelas/kelas", ["nama" => "kelas"]);
    }
    public function getData()
    {
        try {
            return $this->model->selectRaw("
                id, 
                classname, 
                (SELECT program_study_name FROM program_studies WHERE id = classrooms.program_study_id) as nama_jurusan,
                (SELECT COUNT(*) FROM students WHERE classroom_id = id) as jml_siswa
            ")->get();
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }
    }
}
