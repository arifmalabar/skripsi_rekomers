<?php

namespace App\Http\Controllers\Clustering;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Teacher\Grading\GradingDetailController;
use App\Models\Clustering;
use Illuminate\Http\Request;
use App\Models\Teacher\Grade;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ClusteringController extends BaseController
{
    private GradingDetailController $grade;
    public function __construct() {
        $this->model = new Clustering();
        $this->grade = new GradingDetailController();
    }
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
                30,	30,	30,	29,
            ],
            [
                80,	80,	80,	9

            ],
            [
                88,	98,	95,	0,

            ]
        ];
        //$centroid = $this->getCentroid();
        $iterate = 0;
        $maxiterate = 15;
        $student = $this->getGradeStudent($request);
        $histori_jarak = [];
        $histori_cluster = [];
        do {
            $list_jarak = [];
            $clusters = [];
            $list_jarak = $this->hitungJarak($student, $centroid);
            $clusters = $this->buatCluster($list_jarak);
            $centroidBaru = $this->kelompokanCluster($clusters);
            $centroidBaru = $this->rataRataCluster($centroidBaru);
            /*
                PROSES CEK CENTROID BARU
                1. jika nilai centroid lama sama dengan centroid baru maka tambah nilai same
                2. fungsi penjumlahan nilai same digunakan sebagai patokan apakah data sudah konvergen
                    2a. nilai same = 12 -> data sudah konvergen 
                    2b. nilai same < 12 -> ada centroid yang masih berubah/tidak sama dengan centroid baru
            */
            $same = 0;
            foreach (['C1', 'C2', 'C3'] as $index => $cluster) {
                if ($this->isEqual($centroid[$index][0], $centroidBaru[$cluster]['assignment'])) $same++;
                if ($this->isEqual($centroid[$index][1], $centroidBaru[$cluster]['project'])) $same++;
                if ($this->isEqual($centroid[$index][2], $centroidBaru[$cluster]['exams'])) $same++;
                if ($this->isEqual($centroid[$index][3], $centroidBaru[$cluster]['attendance_presence'])) $same++;
            }
            // Update centroid jika ada perubahan
            $centroid_lama = $centroid;
            if ($same != 12) {
                /*
                    update centroid hanya berlaku jika data masih berubah(nilai variabel same < 12)
                */
                foreach (['C1', 'C2', 'C3'] as $index => $cluster) {
                    $centroid[$index][0] = $centroidBaru[$cluster]['assignment'];
                    $centroid[$index][1] = $centroidBaru[$cluster]['project'];
                    $centroid[$index][2] = $centroidBaru[$cluster]['exams'];
                    $centroid[$index][3] = $centroidBaru[$cluster]['attendance_presence'];
                    
                }
            }
            //histori perhitungan 
            array_push($histori_jarak, ["data_jarak" => $clusters, "centroid_lama" => $centroid_lama, "centroid_baru" => $centroid]);
            array_push($histori_cluster, ["iterasi" => $clusters]);
            $totalAttributes = 4; // assignment, project, exams, attendance_presence
            $k = 3;
            $maxSame = $totalAttributes * $k;
            $iterate+=1;
        } while($same != 12 && $iterate < $maxiterate);  // jumlah nilai yang sama == 12 jika dibawah itu maka centroid tidak sama
        //dari perhitungan yang sudah dilakukan tentukan silhouette score
        $silhouette_score = $this->hitungSilhouetteScore($clusters);
        return [
            "jarak" => $histori_jarak,
            "pengelompokan_cluster" => $histori_cluster,
            "hasil" => $clusters,
            "siholuete" => round($silhouette_score, 3)
        ];
        
    }
    private function getCentroid()
    {
        $grade_model = $this->grade->model;
        //Mengambil satu siswa secara acak dari 5 siswa yang memiliki total nilai terendah.
        $lowest = $grade_model->orderByRaw('(assignment + project + exams + attendance_presence) ASC') //urutkan berdasarkan penjumlahan dari total kolom assignment,project, exams, presensi secara naik
                            ->limit(5) //limit data yang ditampilkan adalah 5 data teratas
                            ->inRandomOrder() //acak data yang ditampilkan
                            ->first(); //ambil 1 record dari hasil yang sudah diacak saja

        $middleIndex = floor($grade_model::count() / 2);
        $middle = $grade_model::orderByRaw('(assignment + project + exams + attendance_presence)')
            ->skip($middleIndex)
            ->take(1)
            ->first();

        // Ambil nilai total tertinggi (acak dari 5 teratas)
        $highest = $grade_model::orderByRaw('(assignment + project + exams + attendance_presence) DESC')
            ->limit(5)
            ->inRandomOrder()
            ->first();
        $centroid = [
            [
                $lowest->assignment,
                $lowest->project,
                $lowest->exams,
                $lowest->attendance_presence,
            ],
            [
                $middle->assignment,
                $middle->project,
                $middle->exams,
                $middle->attendance_presence,
            ],
            [
                $highest->assignment,
                $highest->project,
                $highest->exams,
                $highest->attendance_presence,
            ],
        ];
        return $centroid;
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
                pow(($key['exams']-$centroid[0][2]), 2)+ 
                pow(($key["attendance_presence"]-$centroid[0][3]), 2)
            );
            $jarak_centroid2 = sqrt(
                pow(($key['assignment'] - $centroid[1][0]), 2) + 
                pow(($key['project'] - $centroid[1][1]), 2) +
                pow(($key['exams']-$centroid[1][2]), 2) +
                pow(($key["attendance_presence"]-$centroid[1][3]), 2)
            );
            $jarak_centroid3 = sqrt(
                pow(($key['assignment'] - $centroid[2][0]), 2) + 
                pow(($key['project'] - $centroid[2][1]), 2) +
                pow(($key['exams']-$centroid[2][2]), 2) +
                pow(($key["attendance_presence"]-$centroid[2][3]), 2)
            );
            $item_jarak = [
                "student_id" => $key['student_id'],
                "name" => $key["name"],
                "course_id" => $key["course_id"],
                "assignment" => $key["assignment"],
                "project" => $key["project"],
                "exams" => $key["exams"],
                "attendance_presence" => $key["attendance_presence"],
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
                "attendance_presence" => $key["attendance_presence"],
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
            'C1' => ['assignment' => 0, 'project' => 0, 'exams' => 0, 'attendance_presence' => 0,'count' => 0],
            'C2' => ['assignment' => 0, 'project' => 0, 'exams' => 0, 'attendance_presence' => 0,'count' => 0],
            'C3' => ['assignment' => 0, 'project' => 0, 'exams' => 0, 'attendance_presence' => 0,'count' => 0],
        ];

        // Looping pengelompokan
        foreach ($clusters as $key) {
            $cluster = $key['cluster'];
            if (isset($centroidBaru[$cluster])) {
                $centroidBaru[$cluster]['assignment'] += $key['assignment'];
                $centroidBaru[$cluster]['project'] += $key['project'];
                $centroidBaru[$cluster]['exams'] += $key['exams'];
                $centroidBaru[$cluster]['attendance_presence'] += $key['attendance_presence'];
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
                $data['attendance_presence'] /= $data['count'];
            }
        }
        return $centroidBaru;   
    }
    public function isEqual($a, $b)
    {
        $epsilon = 0.1; // atau bahkan 0.1 tergantung kebutuhan konvergensi Anda
        //return abs($a - $b) < $epsilon;
        return round($a, 4) == round($b, 4);
    }
    public function exportAsExcel($request)
    {
        $data = $this->runKmeans($request)["hasil"];
        
        $filename = 'clusterings '.$request["course_id"].'-'.date('Y-m-d').'.xls';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header manual, kolom A sampai H
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Assignment');
        $sheet->setCellValue('C1', 'Project');
        $sheet->setCellValue('D1', 'Exams');
        $sheet->setCellValue('E1', 'Attendance Presence');
        $sheet->setCellValue('F1', 'Centroid 1');
        $sheet->setCellValue('G1', 'Centroid 2');
        $sheet->setCellValue('H1', 'Centroid 3');
        $sheet->setCellValue('I1', 'Cluster');
        // Mulai isi data dari baris ke-2
        $rowNumber = 2;
        foreach ($data as $row) {
            $sheet->setCellValue('A' . $rowNumber, $row['name']);
            $sheet->setCellValue('B' . $rowNumber, $row['assignment']);
            $sheet->setCellValue('C' . $rowNumber, $row['project']);
            $sheet->setCellValue('D' . $rowNumber, $row['exams']);
            $sheet->setCellValue('E' . $rowNumber, $row['attendance_presence']);
            $sheet->setCellValue('F' . $rowNumber, $row['centroid1']);
            $sheet->setCellValue('G' . $rowNumber, $row['centroid2']);
            $sheet->setCellValue('H' . $rowNumber, $row['centroid3']);
            $sheet->setCellValue('I' . $rowNumber, $row['cluster']);
            $rowNumber++;
        }

        $writer = new Xls($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');

        exit;
    }
}
