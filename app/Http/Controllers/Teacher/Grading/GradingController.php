<?php

namespace App\Http\Controllers\Teacher\Grading;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Teacher\BaseTeacherController;
use App\Models\Teacher\Grade;
use Illuminate\Http\Request;

class GradingController extends BaseTeacherController
{
    public function __construct() {
        $this->model = new Grade();
    }
    public function index()
    {
        return view($this->path."penilaian/penilaian", ["nama" => "penilaian"]);
    }

}
