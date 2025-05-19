<?php

use App\Http\Controllers\Headmaster\Clustering\ClusteringHeadmasterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Headmaster\Teacher\TeacherController;
use App\Http\Controllers\Headmaster\Student\StudentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(TeacherController::class)->group(function() {
    $root = "/kakomli/";
    Route::get($root."guru", "index");
    Route::get($root."guru", "getData");
    Route::post($root."guru", "insertData");
    Route::put($root."guru/{id}", "updateData");
    Route::delete($root."guru/{id}", "deleteData");
});
Route::controller(StudentController::class)->group(function(){
    $root = "/kakomli/";
    Route::get($root."detail_kelas/{id}", "index");
    Route::get($root."siswa/api", "getData");
    Route::post($root."siswa/api", "insertData");
});
Route::controller(ClusteringHeadmasterController::class)->group(function () {
    $root = "/kakomli/clustering";

    Route::get($root, "index");
    Route::get($root."/siswa_detail/{id}", "clusteringSiswa");
    Route::get($root."/api", "getData");
    Route::post($root."/api", "insertData");
    Route::post($root."/detail", "getClusteringDetail");
    Route::delete($root."/api", "deleteNilai");
});