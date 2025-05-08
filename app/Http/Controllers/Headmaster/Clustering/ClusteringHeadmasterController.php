<?php

namespace App\Http\Controllers\Headmaster\Clustering;

use App\Http\Controllers\Clustering\ClusteringController;
use App\Http\Controllers\Controller;
use App\Models\Clustering;
use Illuminate\Http\Request;

class ClusteringHeadmasterController extends ClusteringController
{
    private Clustering $mdl;
    public function __construct() {
        $this->mdl = new Clustering();
    }
    public function index()
    {

    }
    public function insertData(Request $request)
    {
        try {
            //return $request->all();
            $old = $this->mdl->where("year", "=", $request["year"])
                             ->where("semester", "=", $request["semester"])
                             ->where("course_id", "=",$request["course_id"]);
            $data_ready = $this->getReadyToInsert($request);
            if($old->count() == 0){
                $this->mdl->insert($data_ready);
            } else{
                $old->delete();
                $this->mdl->insert($data_ready);
            }
            return $data_ready;
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }
    }
    
    public function getReadyToInsert($request)
    {
        $reqdata = $request->all();
        $data = $this->runKmeans($reqdata);
        $ready_toinsert = [];
        foreach ($data['hasil'] as $key) {
            
            $item_data = [
                "course_id" => $key['course_id'],
                "year" => $request->get("year"),
                "semester" => $request->get("semester"),
                "student_id" => $key['student_id'],
                "assignment" => $key["assignment"],
                "project" => $key["project"],
                "exams" => $key["exams"],
                "centroid1" => $key["centroid1"],
                "centroid2" => $key["centroid2"], 
                "centroid3" => $key["centroid3"],
                "cluster" => $key["cluster"],
                "risk" => $key["risk"]
            ];
            array_push($ready_toinsert, $item_data);
        }
        return $ready_toinsert;
    }
}
