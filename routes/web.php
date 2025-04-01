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
});
Route::controller(ProgramStudyController::class)->group(function () {
    $root = "/kakomli/";
    Route::get($root."jurusan", "index");
});
Route::controller(ClassroomController::class)->group(function(){
    $root = "/kakomli/";
    Route::get($root."kelas", "index");
});
Route::controller(StudentController::class)->group(function(){
    $root = "/kakomli/";
    Route::get($root."kelas/{id}", "index");
});
function headMasterRoutes($data)
{

}
/*Route::get('/dashboard', function () {
    return view('dashboard/dashboard', ["nama" => "dashboard"]);
})->name('dashboard');*/
