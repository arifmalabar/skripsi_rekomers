<?php

use App\Http\Controllers\Headmaster\Classroom\ClassroomController;
use App\Http\Controllers\Headmaster\Dashboard\DashboardController;
use App\Http\Controllers\Headmaster\Teacher\TeacherController;
use App\Models\Penghuni;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Headmaster\ProgramStudy\ProgramStudyController;
use App\Http\Controllers\Headmaster\Student\StudentController;

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

Route::controller(DashboardController::class)->group(function() {
    $root = "/kakomli/";
    Route::get($root."dashboard", "index")->name("dashboard");
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
    Route::post($root."api", "insertData");
    Route::put($root."api/{id}", "updateData");
    Route::delete($root."api/{id}", "deleteData");
});
Route::controller(StudentController::class)->group(function(){
    $root = "/kakomli/";
    //Route::get($root."detail_kelas/{id}", "index");
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
