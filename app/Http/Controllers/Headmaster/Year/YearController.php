<?php

namespace App\Http\Controllers\Headmaster\Year;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Headmaster\Year;
use Illuminate\Http\Request;

class YearController extends BaseController
{
    public function __construct() {
        $this->model = new Year();
    }
    public function index()
    {
        
    }
}
