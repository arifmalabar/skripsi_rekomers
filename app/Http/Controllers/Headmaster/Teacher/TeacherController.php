<?php

namespace App\Http\Controllers\Headmaster\Teacher;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Headmaster\Teacher;
use Illuminate\Http\Request;

class TeacherController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->model = new Teacher();
        //$this->kode = "G";
    }   
    public function index()
    {
        return view("headmaster/guru/guru", ["nama" => "guru"]);
    }
    public function insertData(Request $request)
    {
        $request["password"] = bcrypt($request["password"]);
        return parent::insertData($request);
    }
    public function getData()
    {
        try {
            $id = auth()->guard("teachers")->user()->id;
            return $this->model->where("id", "!=", $id)->get();
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }
    }
}
