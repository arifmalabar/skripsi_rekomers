<?php

namespace App\Http\Controllers\Clustering;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher\Grade;

class ClusteringController extends Controller
{
    private $siswa = [
        [
            "course_id"=> "C001",
            "year"=> 2021,
            "semester"=> "GANJIL",
            "student_id"=> "002272323",
            "assignment"=> 100,
            "project"=> 87,
            "exams"=>30,
            "attendance_presence"=> 0
        ],
        [
            "course_id"=>"C001",
            "year"=> 2021,
            "semester"=> "GANJIL",
            "student_id"=> "0027197004",
            "assignment"=> 91,
            "project"=> 85,
            "exams"=> 100,
            "attendance_presence"=> 0
        ],
        [
            "course_id"=> "C001",
            "year"=> 2021,
            "semester"=> "GANJIL",
            "student_id"=>"108323",
            "assignment"=> 56,
            "project"=> 100,
            "exams"=> 89,
            "attendance_presence"=> 0
        ],
        [
            "course_id"=> "C001",
            "year"=> 2021,
            "semester"=> "GANJIL",
            "student_id"=>"1092423",
            "assignment"=> 82,
            "project"=> 78,
            "exams"=> 89,
            "attendance_presence"=> 0
        ],
        [
            "course_id"=> "C001",
            "year"=> 2021,
            "semester"=> "GANJIL",
            "student_id"=>"561212",
            "assignment"=> 52,
            "project"=> 90,
            "exams"=> 89,
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
        /*$result = $this->hitJarak();
        $cluster_assignment = $result['cluster_assignment'];
        $new_centroid = $this->updateCentroid($cluster_assignment);
        return $new_centroid;*/
        return $this->runKmeans();
    }
    public function runKmeans()
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
    public function updateCentroid($cluster_assignment)
    {
        $cluster_data = [];
        foreach ($this->siswa as $siswa) {
            $id = $siswa['student_id'];
            $cluster = $cluster_assignment[$id];
            if (!isset($cluster_data[$cluster])) {
                $cluster_data[$cluster] = ['assignment' => [], 'project' => [], 'exams' => []];
            }
            $cluster_data[$cluster]['assignment'][] = $siswa['assignment'];
            $cluster_data[$cluster]['project'][] = $siswa['project'];
            $cluster_data[$cluster]['exams'][] = $siswa['exams'];
        }
        $centroid_baru = [];
        foreach ($cluster_data as $cluster_name => $values) {
            $avg_assignment = array_sum($values["assignment"]) / count($values['assignment']);
            $avg_project = array_sum($values['project']) / count($values['project']);
            $avg_exams = array_sum($values["exams"]) / count($values["exams"]);
            $centroid_baru[$cluster_name] = [
                round($avg_assignment, 2),
                round($avg_project, 2),
                round($avg_exams, 2)
            ];
        }
        return $centroid_baru;
    }
    private function euclideanDistanceMulti($point, $centroid)
    {
        $sum = 0;
        for ($i = 0; $i < count($point); $i++) {
            $sum += pow($point[$i] - $centroid[$i], 2);
        }
        return sqrt($sum);
    }
}
