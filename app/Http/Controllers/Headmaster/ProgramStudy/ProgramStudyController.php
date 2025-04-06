<?php

namespace App\Http\Controllers\Headmaster\ProgramStudy;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Headmaster\BaseHeadmasterController;
use App\Models\Headmaster\ProgramStudy;
use Illuminate\Http\Request;

class ProgramStudyController extends BaseHeadmasterController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->model = new ProgramStudy();
        //$this->kode = "J";
    }
    public function index()
    {
        return view($this->path."/jurusan/jurusan", ["nama" => "jurusan"]);
    }
    public function getData()
    {
        try {
            return $this->model->selectRaw("id, program_study_name,(SELECT COUNT(*) FROM classrooms WHERE program_study_id = program_studies.id) as jml_kelas")->get();
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }
    }
}
