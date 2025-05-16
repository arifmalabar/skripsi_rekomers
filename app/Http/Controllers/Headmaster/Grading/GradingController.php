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
use App\Http\Controllers\Teacher\Grading\GradingController as Grading;

class GradingController extends Grading
{
    public function __construct() {
        parent::__construct();
    }
    public function index()
    {
        return view("headmaster/penilaian/penilaian", ["nama" => "penilaian"]);
    }
}
