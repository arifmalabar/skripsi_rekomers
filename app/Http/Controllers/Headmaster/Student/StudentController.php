<?php

namespace App\Http\Controllers\Headmaster\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Headmaster\BaseHeadmasterController;
use App\Models\Headmaster\Student;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentController extends BaseHeadmasterController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $classroom_id;
    public function __construct() {
        $this->model = new Student();
        $this->classroom_id = Session::get("classroom_id");
    }
    public function index($id)
    {
        Session::put("classroom_id", $id);
        return view($this->path."/siswa/siswa", ["nama" => "kelas"]);
    }
    public function getData()
    {
        try {
            return $this->model->where("classroom_id", "=", Session::get("classroom_id"))->get();
        } catch (QueryException $th) {
            return $th->getMessage();
        }
    }
    public function insertData(Request $request)
    {
        $request->merge(["classroom_id" => Session::get("classroom_id")]);
        return parent::insertData($request);
    }
    public function insertMultipleData(Request $request)
    {
        try {
            foreach ($request->except("token") as $key) {
                $key["classroom_id"] = Session::get("classroom_id");
                $this->checkAvailable($key);
            }
            return true;
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }
    }
    private function checkAvailable($key)
    {
        $cek = $this->model->where("id", "=", $key["id"]);
        if($cek->count() == 0){
            $this->model->insert($key);
        } else {
            $cek->update($key);
        }
    }
}
