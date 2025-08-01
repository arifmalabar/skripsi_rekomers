<?php

use App\Http\Controllers\Clustering\ClusteringController;
use App\Http\Controllers\Clustering\ElbowController;
use App\Http\Controllers\Headmaster\Classroom\ClassroomController;
use App\Http\Controllers\Headmaster\Clustering\DetailSiswaClusteringController;
use App\Http\Controllers\Headmaster\ClusteringSiswa\ClusteringSiswaController;
use App\Http\Controllers\Headmaster\Course\CourseController;
use App\Http\Controllers\Headmaster\Dashboard\DashboardController;
use App\Http\Controllers\Headmaster\Teacher\TeacherController;
use App\Http\Controllers\Teacher\Grading\GradingController;
use App\Models\Penghuni;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Headmaster\ProgramStudy\ProgramStudyController;
use App\Http\Controllers\Headmaster\Semester\SemesterController;
use App\Http\Controllers\Headmaster\Student\StudentController;
use App\Http\Controllers\Headmaster\Year\YearController;
use App\Http\Controllers\Teacher\Dashboard\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Teacher\Grading\GradingDetailController;
use App\Http\Controllers\Headmaster\Clustering\ClusteringHeadmasterController;
use App\Http\Middleware\HeadmasterMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::middleware(HeadmasterMiddleware::class)->group(function () {
    Route::controller(DashboardController::class)->group(function() {
        $root = "/kakomli/dashboard/";
        Route::get($root, "index")->name("dashboard");
        Route::get($root."api", "getData");
        Route::post($root."api", "insertData");
        Route::put($root."api/{id}", "updateData");
        Route::delete($root."api/{id}", "deleteData");
    });
    
    Route::controller(SemesterController::class)->group(function(){
        $root = "/kakomli/semester/";
        Route::get($root, "index");
        Route::get($root."api", "getData");
        Route::post($root."api", "insertData");
        Route::put($root."api/{id}", "updateData");
        Route::delete($root."api/{id}", "deleteData");
    });
    Route::controller(TeacherController::class)->group(function() {
        $root = "/kakomli/";
        Route::get($root."guru", "index");
        Route::get($root."guru/api", "getData");
        Route::post($root."guru/api", "insertData");
        Route::put($root."guru/api/{id}", "updateData");
        Route::delete($root."guru/api/{id}", "deleteData");
    });
    Route::controller(ProgramStudyController::class)->group(function () {
        $root = "/kakomli/jurusan/";
        Route::get($root, "index");
        Route::get($root."api", "getData");
        Route::post($root."api", "insertData");
        Route::put($root."api/{id}", "updateData");
        Route::delete($root."api/{id}", "deleteData");
    });
    Route::controller(ClassroomController::class)->group(function(){
        $root = "/kakomli/kelas/";
        Route::get($root, "index");
        Route::get($root."api", "getData");
        Route::get($root."api/{id}", "find");
        Route::post($root."api", "insertData");
        Route::put($root."api/{id}", "updateData");
        Route::delete($root."api/{id}", "deleteData");
    });
    Route::controller(StudentController::class)->group(function(){
        $root = "/kakomli/";
        Route::get($root."detail_kelas/{id}", "index");
        Route::get($root."siswa/api", "getData");
        Route::post($root."siswa/api", "insertData");
        Route::post($root."siswa/api/multiple", "insertMultipleData");
        Route::put($root."siswa/api/{id}", "updateData");
        Route::delete($root."siswa/api/{id}", "deleteData");
    });
    Route::controller(YearController::class)->group(function () {
        $root = "/kakomli/tahun_ajaran/";
        Route::get($root."api", "getData");
        Route::post($root."api", "insertData");
        Route::put($root."api/{id}", "updateData");
        Route::delete($root."api/{id}", "deleteData");
    });
    Route::controller(CourseController::class)->group(function(){
        $root = "/kakomli/mata_pelajaran";
        Route::get($root, "index");
        Route::get($root."/api", "getData");
        Route::post($root."/api", "insertData");
        Route::put($root."/api/{id}", "updateData");
        Route::delete($root."/api/{id}", "deleteData");
    });
    Route::controller(ClusteringHeadmasterController::class)->group(function () {
        $root = "/kakomli/clustering";

        Route::get($root, "index");
        Route::get($root."/siswa_detail/{id}", "clusteringSiswa");
        Route::get($root."/api", "getData");
        Route::post($root."/api", "insertData");
        Route::post($root."/detail", "getClusteringDetail");
        Route::delete($root."/api", "deleteNilai");
        Route::get($root."/detail/export", "exportData");
    });
    Route::controller(ElbowController::class)->group(function () {
        $root = "/kakomli/elbow";

        Route::get($root, "index");
    });
});


Route::controller(TeacherDashboardController::class)->group(function() {
    $root = "/teacher/dashboard";
    Route::get($root, "index")->name("/teacher/dashboard");
});
Route::controller(GradingController::class)->group(function () {
    $root = "/teacher/grades";
    Route::get($root, "index");
    Route::get($root."/api", "getData")->name("/teacher/grades");
    Route::post($root."/api", "insertData");
    Route::put($root."/api/{id}", "updateNilai");
    Route::delete($root."/api", "deleteNilai");
});
Route::controller(GradingDetailController::class)->group(function() {
    $root = "/teacher/grades_detail";
    Route::post($root, "index");
    Route::get($root."/api", "getData");
    Route::post($root."/api", "saveNilai");
});

Route::controller(DetailSiswaClusteringController::class)->group(function () {
    $root = "kakomli/detail_cluster/";
    Route::get($root."clustering_siswa/{id}", "index");
    Route::get($root."api", "getData");
    
});
Route::controller(ClusteringSiswaController::class)->group(function () {
    $root = "kakomli/clustering_allsiswa/";
    Route::get($root, "index");
    Route::get($root."api", "getData");
    
});
Route::controller(ClusteringController::class)->group(function () {
    Route::get("/clustering", "index");
});
function routes($data)
{
    $index = 0;
    while(arrayCheck($data, "GET") && $index < count($data["GET"]))
    {
        $uri = $data["GET"][$index];
        Route::get($uri["path"], $uri["action"]);
        $index++;
    }
    $index = 0;
    while(arrayCheck($data, "POST") && $index < count($data["POST"]))
    {
        echo 1;
        $uri = $data["POST"][$index];
        Route::post($uri["path"], $uri["action"]);
        $index++;
    }
   /*if(!(arrayCheck($data, "GET")))
   {
        foreach($data["GET"] as $get)
        {
            Route::get($get["path"], $get["action"]);
        }
   }
   if(!(arrayCheck($data, "POST")))
   {
        foreach($data["POST"] as $post)
        {
            Route::post($post["path"], $post["action"]);
        }
   }
    /*foreach(isset($data["POST"]) as $post)
    {
        Route::post($post["path"], $post["action"]);
    }
    foreach($data["PUT"] as $put)
    {
        Route::put($put["path"], $put["action"]);
    }
    foreach($data["DELETE"] as $del)
    {
        Route::delete($del["path"], $del["action"]);
    }*/
}
function arrayCheck($arr, $type)
{
    if(array_key_exists($type, $arr))
    {
        return true;
    } else {
        return false;
    }
}
/*Route::get('/dashboard', function () {
    return view('dashboard/dashboard', ["nama" => "dashboard"]);
})->name('dashboard');*/
