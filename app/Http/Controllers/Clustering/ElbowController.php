<?php

namespace App\Http\Controllers\Clustering;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Teacher\Grading\GradingDetailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ElbowController extends ClusteringController
{
    public function __construct() {
        parent::__construct();
    }
    public function index()
    {
        $request = ["course_id" => Session::get("course_id"), "year" => Session::get("year"), "semester" => Session::get("semester")];
        
        return $this->elbowMethod($request);
    }
    public function elbowMethod($request)
    {
        $results = [];
        for ($k = 1; $k <= 6; $k++) {
            $data = $this->getGradeStudent($request);
            //shuffle($data);
            $centroid = [];
            for ($i = 0; $i < $k; $i++) {
                $centroid[] = [
                    $data[$i]['assignment'],
                    $data[$i]['project'],
                    $data[$i]['exams'],
                    $data[$i]['attendance_presence'],
                ];
            }

            $maxIter = 15;
            $same = 0;
            $iter = 0;

            do {
                $list_jarak = $this->hitungJarakCustom($data, $centroid);
                $clusters = $this->buatClusterCustom($list_jarak, $k);
                $centroidBaru = $this->kelompokanClusterCustom($clusters, $k);
                $centroidBaru = $this->rataRataClusterCustom($centroidBaru, $k);

                $same = 0;
                for ($i = 0; $i < $k; $i++) {
                    for ($j = 0; $j < 4; $j++) {
                        if ($this->isEqual($centroid[$i][$j], $centroidBaru["C$i"][$j])) {
                            $same++;
                        }
                    }
                }

                if ($same != $k * 4) {
                    for ($i = 0; $i < $k; $i++) {
                        $centroid[$i] = [
                            $centroidBaru["C$i"][0],
                            $centroidBaru["C$i"][1],
                            $centroidBaru["C$i"][2],
                            $centroidBaru["C$i"][3]
                        ];
                    }
                }
                $iter++;
            } while ($same != $k * 4 && $iter < $maxIter);

            $wcss = $this->hitungWCSS($clusters, $centroid);
            $results[] = ["K" => $k, "WCSS" => round($wcss, 2)];
        }

        return $results;
    }
    public function buatClusterCustom($list_jarak, $k)
    {
        $clusters = [];
        foreach ($list_jarak as $item) {
            // Cari jarak minimum dari centroid1 ... centroidK
            $min = null;
            $min_index = null;

            for ($i = 0; $i < $k; $i++) {
                if (is_null($min) || $item["centroid" . ($i + 1)] < $min) {
                    $min = $item["centroid" . ($i + 1)];
                    $min_index = $i;
                }
            }

            $cluster_label = "C" . $min_index;

            $item_cluster = [
                "student_id" => $item['student_id'],
                "name" => $item["name"],
                "course_id" => $item["course_id"],
                "assignment" => $item["assignment"],
                "project" => $item["project"],
                "exams" => $item["exams"],
                "attendance_presence" => $item["attendance_presence"],
            ];

            // Simpan nilai jarak ke semua centroid
            for ($i = 0; $i < $k; $i++) {
                $item_cluster["centroid" . ($i + 1)] = $item["centroid" . ($i + 1)];
            }

            $item_cluster["cluster"] = $cluster_label;

            $clusters[] = $item_cluster;
        }

        return $clusters;
    }
    public function hitungWCSS($clusters, $centroid)
    {
        $wcss = 0;
        foreach ($clusters as $item) {
            $clusterIndex = (int) str_replace("C", "", $item['cluster']);
            $dist = pow($item['assignment'] - $centroid[$clusterIndex][0], 2)
                + pow($item['project'] - $centroid[$clusterIndex][1], 2)
                + pow($item['exams'] - $centroid[$clusterIndex][2], 2)
                + pow($item['attendance_presence'] - $centroid[$clusterIndex][3], 2);
            $wcss += $dist;
        }
        return $wcss;
    }
    public function hitungJarakCustom($student, $centroid)
    {
        $list_jarak = [];
        foreach ($student as $data) {
            $item = [
                "student_id" => $data['student_id'],
                "name" => $data['name'],
                "course_id" => $data['course_id'],
                "assignment" => $data["assignment"],
                "project" => $data["project"],
                "exams" => $data["exams"],
                "attendance_presence" => $data["attendance_presence"]
            ];

            foreach ($centroid as $index => $c) {
                $jarak = sqrt(
                    pow($data['assignment'] - $c[0], 2) +
                    pow($data['project'] - $c[1], 2) +
                    pow($data['exams'] - $c[2], 2) +
                    pow($data['attendance_presence'] - $c[3], 2)
                );
                $item['centroid' . ($index + 1)] = round($jarak, 2);
            }

            $list_jarak[] = $item;
        }
        return $list_jarak;
    }
    public function kelompokanClusterCustom($clusters, $k)
    {
        $centroidBaru = [];
        for ($i = 0; $i < $k; $i++) {
            $centroidBaru["C$i"] = [0, 0, 0, 0, "count" => 0];
        }

        foreach ($clusters as $item) {
            $c = $item['cluster'];
            $centroidBaru[$c][0] += $item['assignment'];
            $centroidBaru[$c][1] += $item['project'];
            $centroidBaru[$c][2] += $item['exams'];
            $centroidBaru[$c][3] += $item['attendance_presence'];
            $centroidBaru[$c]["count"]++;
        }

        return $centroidBaru;
    }
    public function rataRataClusterCustom($centroidBaru, $k)
    {
        for ($i = 0; $i < $k; $i++) {
            $label = "C$i";
            if ($centroidBaru[$label]["count"] > 0) {
                for ($j = 0; $j < 4; $j++) {
                    $centroidBaru[$label][$j] /= $centroidBaru[$label]["count"];
                }
            }
        }
        return $centroidBaru;
    }
}
