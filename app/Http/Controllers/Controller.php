<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\Model;
use Exception;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public Model $model;
    public function getData()
    {
       try {
        return $this->model->get();
       } catch (\Throwable $th) {
        return response()->json($th->getMessage(), $th->getCode());
       }
    }
    public function findData($id)
    {
        try {
            $query = $this->model->findOrFail($id);
            if(!($query->isEmpty()))
            {
                return response()->json($query->get(), 200);
            } else {
                throw new Exception("Error Processing Request", 400);
                
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode());
        }
    }
    public function insertData($data)
    {
        try {
            $query = $this->model->create($data);
            if($query){
                return response()->json(["Berhasil menambah data manufacturing"], 201);
            } else {
                throw new Exception("Error Processing Request", 400);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode());
        }
    }
    public function updateData($id, $data)
    {
        try {
            $query = $this->model->find($id)->update($data);
            if($query){
                return response()->json(["Berhasil mengubah data"], 200);
            } else {
                throw new Exception("Error Processing Request", 400);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode());
        }
    }
    public function deleteData($id)
    {
        try {
            $query = $this->model->find($id)->delete();
            if($query){
                return response()->json(["Berhasil menghapus data"], 200);
            } else {
                throw new Exception("Error Processing Request", 400);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode());
        }
    }

}
