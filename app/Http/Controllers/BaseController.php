<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    public Model $model;
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
            return $this->model->findOrFail($id)->update();
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }
    }
    public function deleteData($named, $id)
    {
        try {
            return $this->model->findOrFail($id)->delete();
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }
    }
    private function showError($message)
    {
        return response()->json($message, 500);
    }

}
