<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Headmaster\Teacher\TeacherController;

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
