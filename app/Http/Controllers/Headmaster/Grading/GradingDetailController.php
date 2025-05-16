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
use App\Http\Controllers\Teacher\Grading\GradingDetailController as GradingDetail;

class GradingDetailController extends GradingDetail
{
    public function __construct() {
        parent::__construct();
    }
    public function index(Request $request)
    {
        $data = $request->except("_token");
        $this->setSession($data);
        return view("headmaster.detail_nilai.detail_nilai", ["nama" => "penilaian"]);
    }
}

