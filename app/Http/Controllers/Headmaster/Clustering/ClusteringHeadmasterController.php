<?php

namespace App\Http\Controllers\Headmaster\Clustering;

use App\Http\Controllers\Clustering\ClusteringController;
use App\Http\Controllers\Controller;
use App\Models\Clustering;
use App\Models\Teacher\Grade;
use Error;
use Illuminate\Http\Request;
use Exception;

class ClusteringHeadmasterController extends ClusteringController
{
    private Clustering $mdl;
    public function __construct() {
        $this->model = new Grade();
        $this->mdl = new Clustering();
        parent::__construct();
    }
    public function index()
    {
        return view("headmaster/clustering/clustering", ["nama" => "clustering"]);
    }
    public function clusteringSiswa($id)
    {
        //set session
        //Session::put("", "")
        return view("headmaster/clustering_siswa/clustering_siswa", ["nama" => "clustering"]);
    }
    public function getData()
    {
        try {
            return $this->mdl->selectRaw("
                            course_id, 
                            course_name,
                            clusterings.year,
                            clusterings.semester"
                        )->join("courses", "courses.id", "=", "clusterings.course_id")
                        ->groupByRaw("year, semester, course_id")
                        ->get();
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }
    }
    
    private function getCountClustering($request)
    {
        $data = [
            "C1" => $this->getClusterCount($request, "C1"),
            "C2" => $this->getClusterCount($request, "C2"),
            "C3" => $this->getClusterCount($request, "C3")
        ];
        return $data;
    }
    private function getClusterCount($request, $cluster)
    {
        return $this->mdl->where("course_id", "=", $request["course_id"])->where("cluster", "=", $cluster)->get()->count();
    }
    public function getClusteringDetail(Request $request)
    {
        try {
            //return $this->runKmeans($request);
            return view("headmaster/detail_clustering/detail_clustering", ["nama" => "clustering", "data" => $this->runKmeans($request), "count" => $this->getCountClustering($request)]);
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }
    }
    
    public function insertData(Request $request)
    {
        try {
            //return $request->all();
            $old = $this->mdl->where("year", "=", $request["year"])
                             ->where("semester", "=", $request["semester"])
                             ->where("course_id", "=",$request["course_id"]);
            $data_ready = $this->getReadyToInsert($request);
            if($old->count() == 0 && sizeof($data_ready) != 0){
                $this->mdl->insert($data_ready);
            } elseif($old->count() != 0 && sizeof($data_ready) != 0) {
                $old->delete();
                $this->mdl->insert($data_ready);
            } else {
                throw new Exception("Data Nilai Tidak ditemukan", 1);
            }
            return $data_ready;
        } catch (Exception $th) {
            return $this->showError($th->getMessage());
        }
    }
    public function condition($request)
    {
        return $this->mdl->where("course_id", "=", $request["course_id"])
                            ->where("year", "=", $request["year"])
                            ->where("semester", "=", $request["semester"]);
    }
    public function deleteNilai(Request $request)
    {
        try {
            $this->condition($request)->delete();
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }
        return response()->json($request->all());
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
