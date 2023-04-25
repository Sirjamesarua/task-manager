<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('task.index');
    // return view('welcome');
});

Route::resource('task', TaskController::class);
Route::post('Custom-sortable', [TaskController::class, "updatePosition"]);
Route::get('/new-task', [TaskController::class, "new"])->name('new-task');
Route::post('/update-task/{id}', [TaskController::class, "updateTask"])->name("update-task");
Route::get('delete-task/{id}', [TaskController::class, "delete"])->name('delete-task');
