<?php

namespace App\Http\Controllers\Headmaster\Classroom;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Headmaster\BaseHeadmasterController;
use App\Models\Headmaster\Classroom;
use Illuminate\Database\QueryException;
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
    private function query()
    {
        return $this->model->selectRaw("
            id, 
            classname, 
            (SELECT program_study_name FROM program_studies WHERE id = classrooms.program_study_id) as nama_jurusan,
            (SELECT COUNT(*) FROM students WHERE students.classroom_id = id) as jml_siswa
        ");
    }
    public function getData()
    {
        try {
            return $this->query()->get();
        } catch (QueryException $th) {
            return $this->showError($th->getMessage());
        }
    }
    public function find($id)
    {
        try {
            return $this->query()->where("program_study_id", "=", $id)->get();
        } catch (QueryException $th) {
            return $this->showError($th->getMessage());
        }
    }
}
