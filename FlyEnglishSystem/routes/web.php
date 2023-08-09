<?php

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

// Route::get('/', function () {
//     return view('Dashboard/home');
// });

// Route::get('Home', [App\Http\Controllers\Home::class, 'index'])->name('Home');

// Home/Dashboard
Route::get('/', [App\Http\Controllers\Home::class, 'index'])->name('Home');



// Students
Route::get('Students', [App\Http\Controllers\Students::class, 'index'])->name('Students');
Route::post('add_student',[App\Http\Controllers\Students::class, 'store'])->name('add_student');
Route::get('/edit_student/{id}',[App\Http\Controllers\Students::class, 'edit'])->name('edit_student');
Route::post('update_student',[App\Http\Controllers\Students::class, 'update'])->name('update_student');


// Type Of Feedbacks
Route::get('Type_Of_Feedbacks', [App\Http\Controllers\TypeofFeedbacks::class, 'index'])->name('Type_Of_Feedbacks');
Route::post('add_feedback',[App\Http\Controllers\TypeofFeedbacks::class, 'store'])->name('add_feedback');
Route::get('/edit_feedback/{id}',[App\Http\Controllers\TypeofFeedbacks::class, 'edit'])->name('edit_feedback');
Route::post('update_feedback',[App\Http\Controllers\TypeofFeedbacks::class, 'update'])->name('update_feedback');


Route::post('update_improve_feedback',[App\Http\Controllers\TypeofFeedbacks::class, 'improve'])->name('update_improve_feedback');


// Books
Route::get('Books', [App\Http\Controllers\Books::class, 'index'])->name('Books');
Route::post('add_books',[App\Http\Controllers\Books::class, 'store'])->name('add_books');
Route::get('/edit_books/{id}',[App\Http\Controllers\Books::class,'edit'])->name('edit_books');
Route::post('update_books',[App\Http\Controllers\Books::class, 'update'])->name('update_books');


// Manage Feedbacks
Route::get('Manage_Feedbacks', [App\Http\Controllers\ManageFeedbacks::class, 'index'])->name('Manage_Feedbacks');
Route::post('manage',[App\Http\Controllers\ManageFeedbacks::class, 'store'])->name('manage');
Route::get('/edit_data/{id}', [App\Http\Controllers\ManageFeedbacks::class, 'edit'])->name('edit_data');
Route::post('update',[App\Http\Controllers\ManageFeedbacks::class, 'update'])->name('update');

Route::get('/delete_id/{id}', [App\Http\Controllers\ManageFeedbacks::class, 'delete_id'])->name('delete_id');
Route::get('/view_data/{id}', [App\Http\Controllers\ManageFeedbacks::class, 'view_data'])->name('view_data');
// delete_id view_data