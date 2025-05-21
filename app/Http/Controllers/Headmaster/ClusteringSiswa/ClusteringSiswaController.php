<?php

namespace App\Http\Controllers\Headmaster\ClusteringSiswa;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Headmaster\Clustering\ClusteringHeadmasterController;
use App\Http\Controllers\Headmaster\Student\StudentController;
use Illuminate\Http\Request;

class ClusteringSiswaController extends ClusteringHeadmasterController
{
    private StudentController $student;
    public function __construct() {
        $this->student = new StudentController();
        parent::__construct();
    }
    public function index()
    {
        return view("headmaster.clustering_siswa.clustering_allsiswa", ["nama" => "clustering_all_siswa"]);
    }
    public function getData()
    {
        try {
            $data = $this->student->model->selectRaw("
                id, 
                name,
                (SELECT COUNT(*) FROM clusterings WHERE clusterings.student_id = id AND cluster = 'C1') as cluster1,
                (SELECT COUNT(*) FROM clusterings WHERE clusterings.student_id = id AND cluster = 'C2') as cluster2,
                (SELECT COUNT(*) FROM clusterings WHERE clusterings.student_id = id AND cluster = 'C3') as cluster3
            ")->get();
            $new_data = [];
            foreach ($data as $key) {
                $key["risiko"] = $this->getRisk($key);
                array_push($new_data, $key);
            }
            return $new_data;
        } catch (\Throwable $th) {
            return $this->showError($th->getMessage());
        }
    }
    private function getRisk($key)
    {
        $risk = "";
        if($key["centroid1"] >= $key["centroid2"] || $key["centroid1"] >= $key["centroid3"]){
            $risk = "high";
        } elseif($key["centroid2"] >= $key["centroid3"] || $key["centroid2"] >= $key["centroid1"]){
            $risk = "medium";
        } elseif($key["centroid3"] >= $key["centroid1"] || $key["centroid3"] >= $key["centroid2"]){
            $risk = "low";
        }
        return $risk;
    }
}
