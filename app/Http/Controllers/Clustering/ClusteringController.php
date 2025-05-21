<?php

namespace App\Http\Controllers\Clustering;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Teacher\Grading\GradingDetailController;
use App\Models\Clustering;
use Illuminate\Http\Request;
use App\Models\Teacher\Grade;

class ClusteringController extends BaseController
{
    private GradingDetailController $grade;
    public function __construct() {
        $this->model = new Clustering();
        $this->grade = new GradingDetailController();
    }
    private $siswa = [
        [
            "course_id"=> "C001",
            "year"=> 2021,
            "semester"=> "GANJIL",
            "student_id"=> "002272323/debug",
            "assignment"=> 20,
            "project"=> 20,
            "exams"=>10,
            "attendance_presence"=> 0
        ],
        [
            "course_id"=>"C001",
            "year"=> 2021,
            "semester"=> "GANJIL",
            "student_id"=> "0027197004",
            "assignment"=> 100,
            "project"=> 100,
            "exams"=> 100,
            "attendance_presence"=> 0
        ],
        [
            "course_id"=> "C001",
            "year"=> 2021,
            "semester"=> "GANJIL",
            "student_id"=>"108323",
            "assignment"=> 90,
            "project"=> 90,
            "exams"=> 97,
            "attendance_presence"=> 0
        ],
        [
            "course_id"=> "C001",
            "year"=> 2021,
            "semester"=> "GANJIL",
            "student_id"=>"1092423",
            "assignment"=> 0,
            "project"=> 65,
            "exams"=> 70,
            "attendance_presence"=> 0
        ],
        [
            "course_id"=> "C001",
            "year"=> 2021,
            "semester"=> "GANJIL",
            "student_id"=>"561212",
            "assignment"=> 50,
            "project"=> 02,
            "exams"=> 87,
            "attendance_presence"=> 0
        ],
    ];

    private $centroid = [
        [50, 60, 40],
        [65, 70, 80],
        [85, 90, 100]
    ];
    public function index()
    {
        //return $this->runKmeans();
    }
    public function getGradeStudent($request)
    {
        return $this->grade->model->join("students", "students.id", "=", "grades.student_id")
        ->where("course_id", "=", $request["course_id"])
        ->where("year", "=", $request["year"])
        ->where("semester", "=", $request["semester"])
        ->get();
    }
    public function runKmeans($request)
    {
        $list_jarak = [];
        $k = 3;
        $centroid = [
            [
                20, 20, 20
            ],
            [
                70, 70, 70
            ],
            [
                100, 100, 100
            ]
        ];
        $iterate = 0;
        $maxiterate = 100;
        $same = 0;
        $student = $this->getGradeStudent($request);
        
        $histori_jarak = [];
        $histori_cluster = [];
        do {
            $iterate++;
            $list_jarak = [];
            $clusters = [];
            $list_jarak = $this->hitungJarak($student, $centroid);
            array_push($histori_jarak, ["data_jarak" => $list_jarak]);
            $clusters = $this->buatCluster($list_jarak);
            array_push($histori_cluster, ["iterasi" => $clusters]);
            //mengelompokan cluster

            //program baru
            $centroidBaru = $this->kelompokanCluster($clusters);
            $centroidBaru = $this->rataRataCluster($centroidBaru);
            $same = 0;
            foreach (['C1', 'C2', 'C3'] as $index => $cluster) {
                if ($this->isEqual($centroid[$index][0], $centroidBaru[$cluster]['assignment'])) $same++;
                if ($this->isEqual($centroid[$index][1], $centroidBaru[$cluster]['project'])) $same++;
                if ($this->isEqual($centroid[$index][2], $centroidBaru[$cluster]['exams'])) $same++;
            }

            // Update centroid jika ada perubahan
            if ($same == 0) {
                foreach (['C1', 'C2', 'C3'] as $index => $cluster) {
                    $centroid[$index][0] = $centroidBaru[$cluster]['assignment'];
                    $centroid[$index][1] = $centroidBaru[$cluster]['project'];
                    $centroid[$index][2] = $centroidBaru[$cluster]['exams'];
                }
            }

            //program lama
            /*$c1_tugas = 0.0; $c1_project = 0.0; $c1_ujian = 0.0;
            $c2_tugas = 0.0; $c2_project = 0.0; $c2_ujian = 0.0;
            $c3_tugas = 0.0; $c3_project = 0.0; $c3_ujian = 0.0;
            $countc1=0; $countc2=0; $countc3 = 0;
            foreach ($clusters as $key) {
                if($key['cluster'] === "C1"){
                    $c1_project += $key['project'];
                    $c1_tugas +=  $key['assignment'];
                    $c1_ujian +=  $key['exams'];
                    $countc1++;
                } else if($key['cluster'] === "C2"){
                    $c2_project += $key['project'];
                    $c2_tugas += $key['assignment'];
                    $c2_ujian += $key['exams'];
                    $countc2++;
                } else if($key['cluster'] === "C3"){
                    $c3_project += $key['project'];
                    $c3_tugas += $key['assignment'];
                    $c3_ujian += $key['exams'];
                    $countc3++;
                }
            }
            //hitung rata rata cluster 
            $same = 0;
            if($countc1 > 0){
                $c1_tugas /= $countc1;
                $c1_project /= $countc1;
                $c1_ujian /= $countc1;
            } 
            if($countc2 > 0){
                $c2_tugas /= $countc2;
                $c2_project /= $countc2;
                $c2_ujian /= $countc2;
            } 
            if($countc3 > 0){
                $c3_tugas /= $countc3;
                $c3_project /= $countc3;
                $c3_ujian /= $countc3;
                $countc3;
            }
            if($this->isEqual($centroid[0][0], $c1_tugas))
            {
                $same+=1;
            }

            if($this->isEqual($centroid[0][1], $c1_project))
            {
                $same+=1;
            }

            if($this->isEqual($centroid[0][2], $c1_ujian))
            {
                $same+=1;
            }

            if($this->isEqual($centroid[1][0], $c2_tugas))
            {
                $same+=1;
            }if($this->isEqual($centroid[1][1], $c2_project))
            {
                $same+=1;
            }
            if($this->isEqual($centroid[1][2], $c2_ujian))
            {
                $same+=1;
            }

            if($this->isEqual($centroid[2][0], $c3_tugas))
            {
                $same+=1;
            }
            if($this->isEqual($centroid[2][1], $c3_project))
            {
                $same+=1;
            }if($this->isEqual($centroid[2][2], $c3_ujian))
            {
                $same+=1;
            }

            if($same == 0){
                $centroid[0][0] = $c1_tugas;
                $centroid[0][1] = $c1_project;
                $centroid[0][2] = $c1_ujian;
                
                $centroid[1][0] = $c2_tugas;
                $centroid[1][1] = $c2_project;
                $centroid[1][2] = $c2_ujian;
                
                $centroid[2][0] = $c3_tugas;
                $centroid[2][1] = $c3_project;
                $centroid[2][2] = $c3_ujian;
                
            }*/
        } while($same == 0 && $iterate < $maxiterate);

        $silhouette_score = $this->hitungSilhouetteScore($clusters);

        return [
            "jarak" => $histori_jarak,
            "pengelompokan_cluster" => $histori_cluster,
            "hasil" => $clusters,
            "siholuete" => round($silhouette_score, 3),
        ];
        
    }
    public function hitungSilhouetteScore($clusters)
    {
        $clusterGroups = [
            'C1' => [],
            'C2' => [],
            'C3' => []
        ];

        foreach ($clusters as $item) {
            $clusterGroups[$item['cluster']][] = $item;
        }

        $scores = [];

        foreach ($clusters as $current) {
            $currentCluster = $current['cluster'];
            $a = 0;
            $b = PHP_FLOAT_MAX;
            $sameCluster = $clusterGroups[$currentCluster];
            $totalInSameCluster = count($sameCluster) - 1;

            // a(i): rata-rata jarak ke cluster sendiri
            foreach ($sameCluster as $other) {
                if ($current['student_id'] === $other['student_id']) continue;
                $a += $this->euclideanDistance($current, $other);
            }
            $a = ($totalInSameCluster > 0) ? $a / $totalInSameCluster : 0;

            // b(i): jarak ke cluster terdekat
            foreach ($clusterGroups as $key => $group) {
                if ($key === $currentCluster) continue;

                $total = 0;
                foreach ($group as $item) {
                    $total += $this->euclideanDistance($current, $item);
                }
                $avg = count($group) > 0 ? $total / count($group) : 0;
                if ($avg < $b) $b = $avg;
            }

            // silhouette s(i)
            $s = ($a == 0 && $b == 0) ? 0 : ($b - $a) / max($a, $b);
            $scores[] = $s;
        }

        return count($scores) > 0 ? array_sum($scores) / count($scores) : 0;
    }
    public function euclideanDistance($a, $b)
    {
        return sqrt(
            pow($a['assignment'] - $b['assignment'], 2) +
            pow($a['project'] - $b['project'], 2) +
            pow($a['exams'] - $b['exams'], 2)
        );
    }
    public function hitungJarak($student, $centroid)
    {   $list_jarak = [];
        foreach ($student as $key) {
            $jarak_centroid1 = sqrt(
                pow(($key['assignment'] - $centroid[0][0]), 2) + 
                pow(($key['project'] - $centroid[0][1]), 2) +
                pow(($key['exams']-$centroid[0][2]), 2)
            );
            $jarak_centroid2 = sqrt(
                pow(($key['assignment'] - $centroid[1][0]), 2) + 
                pow(($key['project'] - $centroid[1][1]), 2) +
                pow(($key['exams']-$centroid[1][2]), 2)
            );
            $jarak_centroid3 = sqrt(
                pow(($key['assignment'] - $centroid[2][0]), 2) + 
                pow(($key['project'] - $centroid[2][1]), 2) +
                pow(($key['exams']-$centroid[2][2]), 2)
            );
            $item_jarak = [
                "student_id" => $key['student_id'],
                "name" => $key["name"],
                "course_id" => $key["course_id"],
                "assignment" => $key["assignment"],
                "project" => $key["project"],
                "exams" => $key["exams"],
                "centroid1"=> round($jarak_centroid1, 2),
                "centroid2" => round($jarak_centroid2, 2),
                "centroid3"=> round($jarak_centroid3, 2)
            ];
            array_push($list_jarak, $item_jarak);
        }
        return $list_jarak;
    }
    public function buatCluster($list_jarak)
    {
        $clusters = [];
        foreach ($list_jarak as $key) {
            $min = min($key["centroid1"], min($key["centroid2"], $key["centroid3"]));
            $cluster = "";
            $risk = "";
            if($min == $key["centroid1"])
            {
                $cluster = "C1";
                $risk = "high";
            } else if($min == $key["centroid2"]){
                $cluster = "C2";
                $risk = "medium";
            } else if($min == $key["centroid3"]){
                $cluster = "C3";
                $risk = "less";
            }
            $item_cluster = [
                "student_id" => $key['student_id'],
                "name" => $key["name"],
                "course_id" => $key["course_id"],
                "assignment" => $key["assignment"],
                "project" => $key["project"],
                "exams" => $key["exams"],
                "centroid1" => $key["centroid1"],
                "centroid2" => $key["centroid2"], 
                "centroid3" => $key["centroid3"],
                "cluster" => $cluster,
                "risk" => $risk
            ];
            array_push($clusters, $item_cluster);
        }
        return $clusters;
    }
    public function kelompokanCluster($clusters)
    {
        $centroidBaru = [
            'C1' => ['assignment' => 0, 'project' => 0, 'exams' => 0, 'count' => 0],
            'C2' => ['assignment' => 0, 'project' => 0, 'exams' => 0, 'count' => 0],
            'C3' => ['assignment' => 0, 'project' => 0, 'exams' => 0, 'count' => 0],
        ];

        // Looping pengelompokan
        foreach ($clusters as $key) {
            $cluster = $key['cluster'];
            if (isset($centroidBaru[$cluster])) {
                $centroidBaru[$cluster]['assignment'] += $key['assignment'];
                $centroidBaru[$cluster]['project'] += $key['project'];
                $centroidBaru[$cluster]['exams'] += $key['exams'];
                $centroidBaru[$cluster]['count']++;
            }
        }
        return $centroidBaru;
    }
    public function rataRataCluster($centroidBaru)
    {
        foreach ($centroidBaru as $cluster => &$data) {
            if ($data['count'] > 0) {
                $data['assignment'] /= $data['count'];
                $data['project'] /= $data['count'];
                $data['exams'] /= $data['count'];
            }
        }
        return $centroidBaru;   
    }
    public function isEqual($a, $b)
    {
        $epsilon = 0.0001;
        return abs($a-$b) < $epsilon;
    }
    public function run()
    {
        $centroid = $this->centroid;
        $max_iterasi = 100; // Batas maksimum iterasi agar tidak infinite loop
        $iterasi = 0;
        $cluster_assignment = [];

        do {
            $changed = false;
            $cluster_assignment = [];

            // Inisialisasi cluster sementara
            foreach ($this->siswa as $siswa) {
                $assignment = $siswa['assignment'];
                $project = $siswa['project'];
                $exams = $siswa['exams'];

                $minDist = PHP_INT_MAX;
                $chosenCluster = 0;

                // Hitung jarak ke setiap centroid
                foreach ($centroid as $i => $c) {
                    $dist = $this->euclideanDistanceMulti([$assignment, $project, $exams], $c);
                    if ($dist < $minDist) {
                        $minDist = $dist;
                        $chosenCluster = $i;
                    }
                }

                // Simpan hasil cluster untuk siswa ini
                $cluster_assignment[$siswa['student_id']] = $chosenCluster;
            }

            // Hitung centroid baru berdasarkan cluster assignment
            $new_centroid = $this->updateCentroid($cluster_assignment);

            // Bandingkan centroid lama dengan yang baru
            if ($new_centroid != $centroid) {
                $changed = true;
                $centroid = $new_centroid;
            }

            $iterasi++;
        } while ($changed && $iterasi < $max_iterasi);

        return [
            'final_centroid' => $centroid,
            'cluster_assignment' => $cluster_assignment,
            'iterations' => $iterasi
        ];
    }
}
