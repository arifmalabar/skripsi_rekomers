<?php

namespace App\Http\Controllers\Headmaster\Course;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Headmaster\Course;
use Illuminate\Http\Request;

class CourseController extends BaseController
{
    public function __construct() {
        $this->model = new Course();
    }
    public function index()
    {
        return view("headmaster/course/course", ["nama" => "course"]);
    }

}
