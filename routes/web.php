<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
   
// });
Route::redirect('/','/book');
Route::resource('/book',BookController::class);