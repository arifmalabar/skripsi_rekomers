<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    public Model $model;
    public $kode = "";
    public function getData()
    {
        try {
            return $this->model->get();
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }
    }
    public function insertData(Request $request)
    {
        $data = $request->all();
        if($this->kode != "")
        {
            $data["id"] = $this->getKode($this->model, $this->kode);
        }
        try {
            return $this->model->insert($data);
        } catch (QueryException $th) {
            return $this->showError($th->getMessage());
        }
    }
    public function inserDataByid(Request $request, $char)
    {
        $data = $request->all();
        $data["id"] = $this->getKode($this->model, $char);
        try {
            return $this->model->insert($data);
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }

    }
    public function updateData(Request $request, $id)
    {
        $data = $request->all();
        try {
            return $this->model->findOrFail($id)->update($data);
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }
    }
    public function activateData($id)
    {
        //$data = $request->all();
        try {
            $field = $this->model->findOrFail($id);
            if($field->status){
                $field->status = false;
            } else {
                $field->status = true;
            }
            $field->save();
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }
    }
    public function deleteData($id)
    {
        try {
            return $this->model->findOrFail($id)->delete();
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }
    }
    protected function showError($message)
    {
        return response()->json(["erorr" => $message], 500);
    }
    private function getKode(Model $mo, $char)
    {
        try {
            $last = $mo->orderBy("id", "DESC")->first();
            if(!$last ||!$last->id)
            {
                return $char."001";
            }
            $lastnum = intval(substr($last->id, 1));
            return $char.str_pad($lastnum+1, 3, "0", STR_PAD_LEFT);
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }
    }

}
