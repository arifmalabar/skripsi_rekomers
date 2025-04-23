<?php

namespace App\Http\Controllers\Teacher\Dashboard;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Teacher\BaseTeacherController;
use Illuminate\Http\Request;

class DashboardController extends BaseTeacherController
{
    public function index()
    {
        return view($this->path."dashboard/dashboard", ["nama" => "dashboard"]);
    }
}
